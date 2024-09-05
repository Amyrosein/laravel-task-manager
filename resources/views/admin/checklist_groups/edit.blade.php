<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit ') . $checklistGroup->name . __(' Checklist Group') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="w-full">
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
                        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                              action="{{ route('admin.checklist_groups.update', $checklistGroup) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="mb-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                    {{ __('Name') }}
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="name" value="{{ $checklistGroup->name }}" name="name" type="text"
                                    placeholder="{{ __('Name') }}">
                            </div>
                            <div class="mt-8">
                                <x-primary-button>
                                    {{ __('Save') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                    <form action="{{ route('admin.checklist_groups.destroy', $checklistGroup) }}"
                          method="POST">
                        @method('DELETE')
                        @csrf
                        <x-danger-button onclick="return confirm('Are you sure?')">
                            {{ __('Delete This Checklist Group') }}
                        </x-danger-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
