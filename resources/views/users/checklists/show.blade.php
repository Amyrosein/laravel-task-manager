<x-app-layout>
    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="w-full">
                        {{ ucwords($checklist->name) }}
                    </div>
                    <div class="relative overflow-x-auto">
                        <div class="w-full text-sm text-gray-800 dark:text-gray-400">
                            @foreach($checklist->tasks as $task)
                                <div x-data="{ open_description_{{ $task->id }}: false }"
                                     class="border-b dark:border-gray-700 py-4">
                                    <!-- Task Title -->
                                    <div class="flex justify-between py-2">
                                        <div class="w-64 px-4">{{ $task->title }}</div>
                                        <div class="w-64 px-4 cursor-pointer"
                                             @click="open_description_{{ $task->id }} = !open_description_{{ $task->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="size-6"
                                                 :class="{'rotate-180': open_description_{{ $task->id }}}"
                                                 class="transition-transform duration-300 size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <!-- Task Description -->
                                    <div x-show="open_description_{{ $task->id }}" x-cloak class="w-3/4 px-4 py-3 ml-8 bg-gray-100 rounded-l-lg min-h-16">
                                        {!! $task->description !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
