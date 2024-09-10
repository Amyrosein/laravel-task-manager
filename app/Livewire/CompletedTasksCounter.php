<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Component;

class CompletedTasksCounter extends Component
{
    public $completed_tasks_count;
    public $tasks_count;

    public $checklist_id;

    public function render()
    {
        return view('livewire.completed-tasks-counter');
    }

    #[On('task_complete')]
    public function updateCounter($checklist_id)
    {

        if ($checklist_id == $this->checklist_id ){
            $this->completed_tasks_count++;
        }
    }
}
