<x-app-layout>
    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <!-- Edit Checklist Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="w-full flex justify-between flex-col">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
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

                        <div class="w-full max-w flex lg:flex-row flex-col justify-between">
                            <form class="xl:w-1/3 lg:w-1/2"
                                  action="{{ route('admin.checklist_groups.checklists.update', [$checklistGroup, $checklist]) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    {{ __('Edit Checklist') }}
                                    <hr>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                        {{ __('Name') }}
                                    </label>
                                    <input name="name" id="name" type="text" value="{{ $checklist->name }}"
                                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <div class="flex items-center justify-between">
                                    <x-primary-button>
                                        {{ __('Save Checklist') }}
                                    </x-primary-button>

                                </div>

                            </form>
                            <br>
                            <!-- Delete Checklist Section -->
                            <form class="flex items-end"
                                  action="{{ route('admin.checklist_groups.checklists.destroy', [$checklistGroup, $checklist]) }}"
                                  method="POST">
                                @method('DELETE')
                                @csrf
                                <x-danger-button
                                    onclick="return confirm('Are you sure you want to delete this checklist?')">
                                    {{ __('Delete This Checklist') }}
                                </x-danger-button>
                            </form>
                            <!-- End Delete Checklist Section -->
                        </div>
                        <br>

                    </div>
                </div>
            </div>
            <br>
            <!-- End Edit Checklist Section -->


            <!-- List of Tasks Section -->

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        {{ __('List of Tasks') }}
                        <hr>
                    </div>
                    @livewire('tasks-table', ['checklist' => $checklist])
                </div>
            </div>

            <br>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- tasks errors -->
                    <div class="w-full">
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

                        <!-- create a new task -->
                        <div class="w-full ">
                            <form
                                action="{{ route('admin.checklists.tasks.store', [$checklist]) }}"
                                method="POST">
                                @csrf

                                <div class="mb-4">
                                    {{ __('Create a New Task') }}
                                    <hr>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                        {{ __('Title') }}
                                    </label>
                                    <input value="{{ old('title') }}" name="title" id="title" type="text"
                                           placeholder="{{ __('Task Title') }}"
                                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="task-textarea">
                                        {{ __('Description') }}
                                    </label>
                                    <textarea name="description" id="task-textarea"
                                              placeholder="{{ __('Task Description') }}" rows="5"
                                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description') }}</textarea>
                                </div>
                                <div class="flex items-center justify-between">
                                    <x-primary-button>
                                        {{ __('Save Task') }}
                                    </x-primary-button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End List of Tasks Section -->
        </div>
    </div>

@section('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#task-textarea'))
        .catch( error => console.error(error))
</script>
@endsection
</x-app-layout>

