<div class="p-6 text-gray-900 w-full flex flex-row gap-2">
    <div class="p-6 text-gray-900 w-9/12 bg-white shadow-sm rounded-lg">
        <div class="w-full">
            {{ ucwords($checklist->name) }}
        </div>
        <table class="table-auto w-full">
            @foreach($checklist->tasks->whereNull('user_id') as $task)

                <!-- Task Title -->
                <tr>
                    <td class="border-b px-2 py-2 w-1/12">
                        <input wire:click="complete_task({{ $task->id }})"
                               type="checkbox"
                               class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                               @if(in_array($task->id, $completed_tasks)) checked @endif
                        >
                    </td>
                    <td wire:click="toggle_task({{ $task->id }})"
                        class="border-b px-4 py-2 w-5/12">{{ $task->title }}</td>
                    <td wire:click="toggle_task({{ $task->id }})" class="border-b px-4 py-2 w-6/12">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor"
                             class="transition-transform duration-300 size-6 {{ in_array($task->id, $opened_tasks) ? 'rotate-180' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </td>
                </tr>
                <!-- Task Description -->
                @if(in_array($task->id, $opened_tasks))
                    <tr class="bg-gray-100">
                        <td class="border-b px-4 py-2 w-1/12"></td>
                        <td class="border-b px-4 py-2 w-11/12" colspan="2">
                            {!! $task->description !!}
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
</div>
