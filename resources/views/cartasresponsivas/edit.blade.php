<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Inventario') }}
        </h2>
    </x-slot>

    <div class="py-4">
        {{ $id }}
        {{-- @livewire('cartasresponsivas.create') --}}
    </div>
</x-app-layout>
