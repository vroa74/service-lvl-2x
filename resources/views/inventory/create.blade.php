<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Crear Inventario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @livewire('inventory.create')
    </div>
</x-app-layout>
