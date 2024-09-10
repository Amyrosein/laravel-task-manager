<?php

namespace App\Livewire;

use App\Models\ChecklistGroup;
use Livewire\Attributes\On;
use Livewire\Component;

class HeaderTotalsCount extends Component
{
    public $checklist_group;
    public $checklist_group_id;
    public $checklists;

    #[On('task_complete')]
    public function render()
    {
        $this->checklist_group = ChecklistGroup::find($this->checklist_group_id)->load('checklists');
        $this->checklists = $this->checklist_group->checklists()
            ->whereNull('user_id')
            ->withCount(['tasks' => function($query) {
                $query->whereNull('user_id');
            }])
            ->withCount(['user_tasks' => function($query) {
                $query->whereNotNull('completed_at');
            }])
            ->get();

        return view('livewire.header-totals-count');
    }
}
