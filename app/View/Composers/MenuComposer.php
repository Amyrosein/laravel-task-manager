<?php

namespace App\View\Composers;

use App\Models\Checklist;
use Illuminate\View\View;

class MenuComposer
{
    public function compose(View $view): void
    {
        $menu = \App\Models\ChecklistGroup::with([
            'checklists' => function ($query) {
                $query->whereNull('user_id');
            },
        ])->get();

        $view->with('admin_menu', $menu);

        $groups = collect([]);

        $last_action_at = auth()->user()->last_action_at;
        if (is_null($last_action_at)) {
            $last_action_at = now()->subYear(10);
        }

        $user_checklists = Checklist::where('user_id', auth()->id())->get();
        foreach ($menu as $group) {
            if (count($group->checklists) > 0) {
                $group_updated_at = $user_checklists->where('checklist_group_id', $group->id)->max('updated_at');
                if (is_null($group_updated_at)) {
                    $group_updated_at = now()->subYear();
                }

                $group->is_new     = $group->created_at->greaterThan($group_updated_at);
                $group->is_updated = ! ($group->is_new) && $group->updated_at->greaterThan($group_updated_at);

                foreach ($group->checklists as &$checklist) {
                    $checklist_updated_at = $user_checklists->where('checklist_id', $checklist->id)->max(
                        'updated_at'
                    );
                    if (is_null($checklist_updated_at)) {
                        $checklist_updated_at = now()->subYear();
                    }
                    $checklist->is_new          = ! ($group->is_new) && $checklist->created_at->greaterThan(
                            $checklist_updated_at
                        );
                    $checklist->is_updated      = ! ($group->is_new) && ! ($group->is_updated) && ! ($checklist->is_new) && $checklist->updated_at->greaterThan(
                            $checklist_updated_at
                        );
                    $checklist->tasks           = 1;
                    $checklist->completed_tasks = 0;
                }
                $groups[] = $group;
            }
        }

        $view->with('user_menu', $groups);
    }
}
