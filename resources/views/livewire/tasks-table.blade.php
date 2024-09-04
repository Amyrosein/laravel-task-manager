<div>
    <div class="overflow-x-auto">
        <ul class="border-gray-300 divide-y divide-gray-200 w-full" wire:sortable="updateTaskOrder">
            <!-- Table Row 1 -->
            @foreach ($tasks as $task)
                <li class="flex hover:bg-gray-50 w-64 sm:w-full" wire:sortable.item="{{ $task->id }}" wire:key="task-{{ $task->id }}">
                    <div  class="w-3/4 p-4 flex justify-start items-center">
                        {{ $task->title }}
                    </div>
                    <div class="w-1/3 p-4 flex justify-center items-center">
                        <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                           --}}
                           href="{{ route('admin.checklists.tasks.edit', [$checklist, $task]) }}">
                            Edit
                        </a>
                        <form class="inline-block"
                              action="{{ route('admin.checklists.tasks.destroy', [$checklist, $task]) }}"
                              method="POST">
                            @method('DELETE')
                            @csrf
                            <x-danger-button
                                onclick="return confirm('Are you sure you want to delete this Task?')">
                                {{ __('Delete') }}
                            </x-danger-button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
