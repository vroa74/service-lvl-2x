<div>
    @php
        $id = 1;
    @endphp
    <a href="{{ route('cartasresponsivas.create') }}">
        <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">
            Crear
        </button>
    </a>
    <a href="{{ route('cartasresponsivas.edit', $id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-2 px-4 rounded">
        Editar
    </a>
</div>
