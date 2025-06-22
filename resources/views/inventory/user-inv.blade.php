<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Usuarios - Inventarios
        </h2>
    </x-slot>

    <div class="py-4">        
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border border-gray-700">
                <livewire:inventory.user-inv />
            </div>        
    </div>
</x-app-layout>
