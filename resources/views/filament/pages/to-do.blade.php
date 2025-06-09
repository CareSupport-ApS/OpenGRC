<x-filament::page>
    <x-filament::card>
        <x-slot name="header">
            <h2 class="text-xl font-bold">Your Data Requests</h2>
        </x-slot>
        @livewire('data-request-response-table')
    </x-filament::card>
    <x-filament::card>
        <x-slot name="header">
            <h2 class="text-xl font-bold">Your Pending Tasks</h2>
        </x-slot>
        @livewire('pending-tasks-table')
    </x-filament::card>
</x-filament::page>
