<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 flex">
    <!-- Sidebar -->
    <div class="w-72 bg-gray-800 text-white flex flex-col">
        <div class="p-4 text-lg font-semibold">Checklister</div>
        <nav class="mt-6 flex-1">
            @if(auth()->user()->is_admin)
                <div class="pl-2.5 text-xs font-semibold">Admin</div>
                <ul>
                    <li class="px-4 py-2 hover:bg-gray-700 flex items-center">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                            </svg>
                        </div>
                        <x-nav-link :href="route('admin.pages.index')"
                                    :active="request()->routeIs('admin.pages.index')">
                            {{ __('Pages') }}
                        </x-nav-link>
                    </li>
                    @foreach(\App\Models\ChecklistGroup::with('checklists')->get() as $group)
                        <!-- Dropdown Menu -->
                        <li x-data="{ open: {{ request()->is("admin/checklist_groups/{$group->id}*") ? 'true' : 'false' }} }">
                            <div
                                @class([
                                    'flex items-center justify-between px-4 py-2 hover:bg-gray-700',
                                    'bg-gray-700' => request()->is("admin/checklist_groups/{$group->id}/edit"),
                                    ])>
                                <!-- "developers" anchor link -->
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5"></path>
                                    </svg>
                                </div>
                                <x-nav-link :href="route('admin.checklist_groups.edit', $group)"
                                            :active='request()->is("admin/checklist_groups/{$group->id}/edit")'
                                >
                                    {{ ucwords($group->name) }}
                                </x-nav-link>

                                <!-- Dropdown toggle button -->
                                <button @click="open = !open" class="focus:outline-none">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform duration-300"
                                             :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>

                            <!-- Dropdown menu -->
                            <ul x-show="open"

                                x-transition:enter="transition ease-linear duration-100"
                                x-transition:enter-start="opacity-0 transform scale-y-75"
                                x-transition:enter-end="opacity-100 transform scale-y-100"
                                x-transition:leave="transition ease-linear duration-100"
                                x-transition:leave-start="opacity-100 transform scale-y-100"
                                x-transition:leave-end="opacity-0 transform scale-y-75"
                                class="text-sm mt-1 rounded-lg origin-top overflow-hidden"
                                @if(!request()->is("admin/checklist_groups/{$group->id}*"))
                                    x-cloak
                                @endif
                            >
                                @foreach($group->checklists as $checklist)
                                    <li @class([
                                    'px-4 py-2 hover:bg-gray-700 flex items-center space-x-2 pl-8',
                                    'bg-gray-700' => request()->is("admin/checklist_groups/{$group->id}/checklists/{$checklist->id}/edit"),
                                    ])>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"></path>
                                            </svg>
                                        </div>
                                        <x-nav-link
                                            :href="route('admin.checklist_groups.checklists.edit', [$group, $checklist])"
                                            :active='request()->is("admin/checklist_groups/{$group->id}/checklists/{$checklist->id}/edit")'
                                        >
                                            {{ ucwords($checklist->name) }}
                                        </x-nav-link>
                                    </li>
                                @endforeach
                                <li @class([
                                    'px-4 py-2 hover:bg-gray-700 flex items-center space-x-2 pl-8',
                                    'bg-gray-700' => request()->is("admin/checklist_groups/{$group->id}/checklists/create"),
                                    ])
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <x-nav-link :href="route('admin.checklist_groups.checklists.create', $group)"
                                                :active='request()->is("admin/checklist_groups/{$group->id}/checklists/create")'
                                    >
                                        {{ __('New Checklist') }}
                                    </x-nav-link>
                                </li>
                            </ul>
                        </li>
                    @endforeach

                    <li @class([
                                    'px-4 py-2 hover:bg-gray-700 flex items-center',
                                    'bg-gray-700' => request()->routeIs('admin.checklist_groups.create'),
                                    ])
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                        <x-nav-link :href="route('admin.checklist_groups.create')">

                            {{ __('New Checklist Group') }}
                        </x-nav-link>
                    </li>
                    @endif


                </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1">
        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="p-8">
            {{ $slot }}
        </main>
    </div>
</div>
</body>
</html>
