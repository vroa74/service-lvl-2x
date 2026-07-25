<div class="p-4 bg-gray-800 rounded-lg">
    <button wire:click="testClick" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Probar Botón Livewire
    </button>

    @if ($message)
        <div class="mt-2 p-2 bg-green-600 text-white rounded">
            {{ $message }}
        </div>
    @endif
</div>
