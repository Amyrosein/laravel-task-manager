<?php

namespace App\Livewire;

use Livewire\Component;

class ChecklistShow extends Component
{
    public $checklist;
    public $opened_tasks = [];

    public function toggle_task($task_id)
    {
        if (($key = array_search($task_id, $this->opened_tasks)) !== false) {
            unset($this->opened_tasks[$key]);
        } else {
            $this->opened_tasks[] = $task_id;
        }
    }

    public function render()
    {
        return view('livewire.checklist-show');
    }
}
