<?php

namespace App\Services;

use App\Models\Checklist;
use App\Models\ChecklistGroup;

class MenuService
{
    public function get_menu(): array
    {
        $menu = ChecklistGroup::with([
            'checklists' => function ($query) {
                $query->whereNull('user_id');
            },
            'checklists.tasks' => function ($query) {
                $query->whereNull('tasks.user_id');
            },
            'checklists.user_tasks'
        ])->get();

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
                    $checklist->is_new                = ! ($group->is_new) && $checklist->created_at->greaterThan(
                            $checklist_updated_at
                        );
                    $checklist->is_updated            = ! ($group->is_new) && ! ($group->is_updated) && ! ($checklist->is_new) && $checklist->updated_at->greaterThan(
                            $checklist_updated_at
                        );
                    $checklist->tasks_count           = $checklist->tasks->count();
                    $checklist->completed_tasks_count = $checklist->user_tasks->count();
                }
                $groups[] = $group;
            }
        }
        return [
            'admin_menu' => $menu,
            'user_menu' => $groups,
        ];
    }
}
