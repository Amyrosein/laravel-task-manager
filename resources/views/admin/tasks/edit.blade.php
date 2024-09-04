<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Edit Task Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="w-full flex justify-between flex-col">
                        @if ($errors->storetask->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->storetask->all() as $error)
                                        <li>
                                            <div class="bg-red-100 border-l-4 border-orange-500 text-orange-700 p-4"
                                                 role="alert">
                                                <p class="font-bold">{{ $error }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <!-- edit task -->
                            <div class="w-full max-w-xs">
                                <form
                                    action="{{ route('admin.checklists.tasks.update', [$checklist, $task]) }}"
                                    method="POST">
                                    @method('PUT')
                                    @csrf

                                    <div class="mb-4">
                                        {{ __('Edit Task') }} {{ $task->title }}
                                        <hr>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                            {{ __('Title') }}
                                        </label>
                                        <input value="{{ $task->title }}" name="title" id="title" type="text"

                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                            {{ __('Description') }}
                                        </label>
                                        <textarea name="description" id="description"
                                                  rows="5"
                                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $task->description }}</textarea>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <x-primary-button>
                                            {{ __('Save Task') }}
                                        </x-primary-button>

                                    </div>
                                </form>
                            </div>
                        <!-- end of edit task -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
