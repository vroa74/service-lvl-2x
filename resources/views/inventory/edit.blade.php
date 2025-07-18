<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Editar Inventario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @livewire('inventory.edit', ['id' => $id])
    </div>
</x-app-layout>
