<aside x-show="isSidebarOpen"
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0 transform -translate-x-full"
       x-transition:enter-end="opacity-100 transform translate-x-0"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="opacity-100 transform translate-x-0"
       x-transition:leave-end="opacity-0 transform -translate-x-full"
       class="w-72 bg-gray-800 text-white flex flex-col">
    <div class="px-3 pt-3 text-lg font-semibold text-center">Checklister</div>
    <nav class="flex-1">
        <ul>
            @if(auth()->user()->is_admin)
                <div class="pl-2.5 text-xs font-semibold py-1.5 border-b-blue-400 border-b w-1/2">Manage Checklists
                </div>

                @foreach($admin_menu as $group)
                    <!-- Dropdown Menu -->
                    <li x-data="{ open: {{ request()->is("admin/checklist_groups/{$group->id}*") ? 'true' : 'false' }} }">
                        <div
                            @class([
                                'flex items-center justify-between px-4 py-1.5 hover:bg-gray-700',
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
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-5 w-5 transform transition-transform duration-300"
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
                                    'px-4 py-1.5 hover:bg-gray-700 flex items-center space-x-2 pl-8',
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
                                    'px-4 pb-1.5 pt-2.5 hover:bg-gray-700 flex items-center space-x-2 pl-8',
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
                                    'px-4 py-1.5 hover:bg-gray-700 flex items-center',
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
                <!-- Pages -->
                <div
                    class="pl-2.5 text-xs font-semibold py-1.5.5 border-b-blue-400 border-b w-1/2 mt-4">{{ __('Pages') }}</div>
                @foreach(\App\Models\Page::all() as $page)
                    <li class="px-4 py-1.5 hover:bg-gray-700 flex items-center {{ request()->is("admin/pages/{$page->id}/edit") ? 'bg-gray-700' : '' }}">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z"/>
                            </svg>
                        </div>
                        <x-nav-link :href="route('admin.pages.edit', $page)"
                                    :active='request()->is("admin/pages/{$page->id}/edit")'>
                            {{ $page->title }}
                        </x-nav-link>
                    </li>
                @endforeach

                <!-- Users -->
                <div
                    class="pl-2.5 text-xs font-semibold py-1.5 border-b-blue-400 border-b w-1/2 mt-4">{{ __('Manage Data') }}</div>
                <li class="px-4 py-1.5 hover:bg-gray-700 flex items-center {{ request()->is("admin/users*") ? 'bg-gray-700' : '' }}">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                        </svg>
                    </div>
                    <x-nav-link :href="route('admin.users.index')"
                                :active='request()->is("admin/users*")'>
                        {{ __('Users') }}
                    </x-nav-link>
                </li>
            @else
                <!-- not Admin users -->
                @foreach($user_menu as $group)
                    @if($group->checklists()->count() > 0)
                        <li class="px-4 text-xs font-semibold py-1.5 border-b-blue-400 border-b flex justify-between">
                            <div class="inline-block">
                                {{ $group->name }}
                            </div>

                            @if($group->is_new)
                                <span class="bg-blue-700 text-white font-boldpy-0.5 px-1.5 rounded mr-4" style="font-size: .6rem">
                                        New
                                    </span>
                            @elseif($group->is_updated)
                                <span class="bg-green-700 text-white font-boldpy-0.5 px-1.5 rounded mr-10" style="font-size: .6rem">
                                        Updated
                                    </span>
                            @endif
                        </li>
                        @foreach($group->checklists as $checklist)
                            <li @class([
                                    'px-4 py-1.5 hover:bg-gray-700 flex items-end space-x-2 pl-8',
                                    'bg-gray-700' => request()->is("checklists/{$checklist->id}"),
                                    ])>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                    </svg>
                                </div>
                                <x-nav-link
                                    :href="route('users.checklists.show', [$checklist])"
                                    :active='request()->is("checklists/{$checklist->id}")'
                                >
                                    {{ ucwords($checklist->name) }}
                                </x-nav-link>

                                @livewire('completed-tasks-counter', [
                                    'completed_tasks_count' => $checklist->completed_tasks_count,
                                    'tasks_count' => $checklist->tasks_count,
                                    'checklist_id' => $checklist->id,
                                ])

                                @if($checklist->is_new)
                                    <span class="bg-blue-700 text-white font-bold py-0.5 px-1.5 rounded text-xs">
                                        New
                                    </span>
                                @elseif($checklist->is_updated)
                                    <span class="bg-green-700 text-white font-bold py-0.5 px-1.5 rounded text-xs">
                                        Updated
                                    </span>
                                @endif
                            </li>
                        @endforeach
                    @endif
                @endforeach
            @endif
        </ul>
    </nav>
</aside>
