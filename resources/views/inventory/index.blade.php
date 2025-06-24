<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Inventario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- <div class="max-w-full mx-auto sm:px-6 lg:px-8"> --}}
            {{-- <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg"> --}}
                @livewire('cartasresponsivas.create')
            {{-- </div> --}}
        {{-- </div> --}}
    </div>
</x-app-layout>
