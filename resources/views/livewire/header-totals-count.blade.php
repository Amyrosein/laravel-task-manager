<div class="p-6 text-gray-900">
    <div class="w-full">
        {{ ucwords($checklist_group->name) }}
    </div>
    <!-- Progress -->
    <div class="flex flex-row w-2/3">
        @foreach($checklists as $checklist)
            <div class="lg:w-1/6 w-2/6 p-2 m-2 flex flex-col justify-between">
                <div class="mb-2 flex justify-between items-center">
                    <h3 class="text-sm font-semibold text-gray-800 dark:text-white">{{ $checklist->name }}</h3>
                </div>
                <div class="flex flex-col">
                    <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
                         role="progressbar"
                         @if($checklist->tasks_count > 0)
                             aria-valuenow="{{ ($checklist->user_tasks_count / $checklist->tasks_count) * 100  }}"
                         @endif
                         aria-valuemin="0" aria-valuemax="100">
                        <div
                            class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 text-xs text-white text-center whitespace-nowrap transition-all duration-500 ease-in-out dark:bg-blue-500"
                            @if($checklist->tasks_count > 0)
                                style="width: {{ ($checklist->user_tasks_count / $checklist->tasks_count) * 100  }}%"
                            @endif
                        ></div>
                    </div>
                    <div class="text-sm text-gray-800 dark:text-white ">
                        {{ $checklist->user_tasks_count }} / {{ $checklist->tasks_count }}
                    </div>
                </div>
            </div>
        @endforeach
        <div class="lg:w-1/6 w-2/6 p-2 m-2 flex flex-row justify-center items-center">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white text-center h-auto">
                {{ $checklists->sum('user_tasks_count') }} / {{ $checklists->sum('tasks_count') }}
            </h3>
        </div>
    </div>
    <!-- End Progress -->
</div>
