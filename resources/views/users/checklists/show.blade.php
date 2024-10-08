<x-app-layout>
    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden  sm:rounded-lg">
                @livewire('header-totals-count', ['checklist_group_id' => $checklist->checklist_group_id])
            </div>
            <div class="overflow-hidden sm:rounded-lg">
                @livewire('checklist-show', ['checklist' => $checklist])
            </div>
        </div>
    </div>

</x-app-layout>
