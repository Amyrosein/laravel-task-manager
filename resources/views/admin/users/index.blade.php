<x-app-layout>
    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <!-- Edit Checklist Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <div class="overflow-x-auto">
                            <ul class="border-gray-300 divide-y divide-gray-200 w-full" >
                                <!-- Head -->
                                <li class="flex hover:bg-gray-50 w-64 sm:w-full">
                                    <div  class="w-3/4 p-4 flex justify-start items-center bg-gray-200">
                                        {{ __('Register Date') }}
                                    </div>
                                    <div  class="w-3/4 p-4 flex justify-start items-center bg-gray-200">
                                        {{ __('Name') }}
                                    </div>
                                    <div  class="w-3/4 p-4 flex justify-start items-center bg-gray-200">
                                        {{ __('Email') }}
                                    </div>
                                    <div  class="w-3/4 p-4 flex justify-start items-center bg-gray-200">
                                        {{ __('Website') }}
                                    </div>
                                </li>
                                <!-- Table Row 1 -->
                                @foreach ($users as $user)
                                    <li class="flex hover:bg-gray-50 w-64 sm:w-full">
                                        <div  class="w-3/4 p-4 flex justify-start items-center">
                                            {{ $user->created_at }}
                                        </div>
                                        <div  class="w-3/4 p-4 flex justify-start items-center">
                                            {{ $user->name }}
                                        </div>
                                        <div  class="w-3/4 p-4 flex justify-start items-center">
                                            {{ $user->email }}
                                        </div>
                                        <div  class="w-3/4 p-4 flex justify-start items-center">
                                            {{ $user->website }}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

