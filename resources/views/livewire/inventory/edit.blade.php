{{-- ======================= INICIO: Contenedor Principal ======================= --}}
<div class="bg-gray-800 rounded-lg mb-1 shadow-xl w-full max-w-full px-8 mx-auto">
    {{-- ======================= INICIO: Header del formulario ======================= --}}
    <div class="p-1 border-b border-gray-700">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-white">
                Editar Artículo de Inventario
            </h3>
            <a href="{{ route('inventario.index') }}"
                class="text-gray-400 hover:text-white transition-colors">
                <x-lucide name="x" class="w-6 h-6" />
            </a>
        </div>
    </div>
    {{-- ======================= FIN: Header del formulario ======================= --}}

    {{-- ======================= INICIO: Mensajes de éxito y error ======================= --}}
    @if (session()->has('message'))
        <div class="p-4 mb-4 bg-green-600 border border-green-500 rounded-lg">
            <div class="flex items-center justify-between">
                <p class="text-white font-medium">{{ session('message') }}</p>
                <button onclick="this.parentElement.parentElement.remove()" class="text-green-200 hover:text-white">
                    <x-lucide name="x" class="w-5 h-5" />
                </button>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="p-4 mb-4 bg-red-600 border border-red-500 rounded-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white font-medium">Error al guardar:</p>
                    <p class="text-red-200 text-sm mt-1">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-red-200 hover:text-white">
                    <x-lucide name="x" class="w-5 h-5" />
                </button>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 mb-4 bg-red-600 border border-red-500 rounded-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white font-medium">Errores de validación:</p>
                    <ul class="text-red-200 text-sm mt-1 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-red-200 hover:text-white">
                    <x-lucide name="x" class="w-5 h-5" />
                </button>
            </div>
        </div>
    @endif
    {{-- ======================= FIN: Mensajes de éxito y error ======================= --}}

    {{-- ======================= INICIO: Formulario de Edición ======================= --}}
    <form wire:submit.prevent="saveInventory" class="p-6 space-y-6">


        {{-- ======================= INICIO: Usuarios ======================= --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <label for="user" class="block text-sm font-medium text-gray-300">
                        Usuario (user_id)
                    </label>
                    <button
                        type="button"
                        wire:click="openUserModal('user')"
                        class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors flex items-center gap-1">
                        <x-lucide name="users" class="w-4 h-4" />
                    </button>
                </div>
                <input
                    wire:model="user"
                    type="text"
                    id="user"
                    readonly
                    class="w-full px-3 py-2 bg-gray-600 border border-gray-600 rounded-lg text-white placeholder-gray-400 cursor-not-allowed"
                    placeholder="Seleccionar usuario"
                >
                @error('user_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                @error('user') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <label for="resguardante" class="block text-sm font-medium text-gray-300">
                        Resguardante (res_id)
                    </label>
                    <button
                        type="button"
                        wire:click="openUserModal('responsible')"
                        class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors flex items-center gap-1">
                        <x-lucide name="users" class="w-4 h-4" />
                    </button>
                </div>
                <input
                    wire:model="resguardante"
                    type="text"
                    id="resguardante"
                    readonly
                    class="w-full px-3 py-2 bg-gray-600 border border-gray-600 rounded-lg text-white placeholder-gray-400 cursor-not-allowed"
                    placeholder="Seleccionar resguardante"
                >
                @error('res_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                @error('resguardante') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="resguardante_edit" class="block text-sm font-medium text-gray-300 mb-2">
                    Nombre del Resguardante
                </label>
                <input
                    wire:model="resguardante_edit"
                    type="text"
                    id="resguardante_edit"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Nombre del resguardante"
                >
                @error('resguardante_edit') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        {{-- ======================= FIN: Usuarios ======================= --}}

        {{-- ======================= INICIO: Información del artículo ======================= --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="articulo" class="block text-sm font-medium text-gray-300 mb-2">
                    Artículo <span class="text-red-400">*</span>
                </label>
                <input
                    wire:model.live="articulo"
                    type="text"
                    id="articulo"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('articulo') border-red-500 @enderror"
                    placeholder="Nombre del artículo"
                >
                @error('articulo') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="type" class="block text-sm font-medium text-gray-300 mb-2">
                    Tipo
                </label>
                <input
                    wire:model.live="type"
                    type="text"
                    id="type"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('type') border-red-500 @enderror"
                    placeholder="Tipo de artículo"
                >
                @error('type') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="ni" class="block text-sm font-medium text-gray-300 mb-2">
                    Número de Inventario (NI)
                </label>
                <input
                    wire:model="ni"
                    type="text"
                    id="ni"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Número de inventario"
                >
                @error('ni') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="ns" class="block text-sm font-medium text-gray-300 mb-2">
                    Número de Serie (NS)
                </label>
                <input
                    wire:model="ns"
                    type="text"
                    id="ns"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Número de serie"
                >
                @error('ns') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="marca" class="block text-sm font-medium text-gray-300 mb-2">
                    Marca
                </label>
                <input
                    wire:model="marca"
                    type="text"
                    id="marca"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Marca del artículo"
                >
                @error('marca') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
            <div>
                <label for="modelo" class="block text-sm font-medium text-gray-300 mb-2">
                    Modelo
                </label>
                <input
                    wire:model="modelo"
                    type="text"
                    id="modelo"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Modelo del artículo"
                >
                @error('modelo') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        {{-- ======================= FIN: Información del artículo ======================= --}}

        {{-- ======================= INICIO: Información de PC ======================= --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="flex items-center">
                    <input
                        wire:model="is_pc"
                        type="checkbox"
                        class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                    >
                    <span class="ml-2 text-sm text-gray-300">Es PC</span>
                </label>
            </div>
            <div>
                <label for="gpo" class="block text-sm font-medium text-gray-300 mb-2">
                    Grupo
                </label>
                <input
                    wire:model="gpo"
                    type="text"
                    id="gpo"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Grupo"
                >
                @error('gpo') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="disp" class="block text-sm font-medium text-gray-300 mb-2">
                    Dispositivo
                </label>
                <input
                    wire:model="disp"
                    type="text"
                    id="disp"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Dispositivo"
                >
                @error('disp') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        {{-- ======================= FIN: Información de PC ======================= --}}

        {{-- ======================= INICIO: Información adicional ======================= --}}
        <div>
            <label for="observaciones" class="block text-sm font-medium text-gray-300 mb-2">
                Observaciones
            </label>
            <textarea
                wire:model="observaciones"
                id="observaciones"
                rows="3"
                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Observaciones adicionales"
            ></textarea>
            @error('observaciones') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="flex items-center">
                <input
                    wire:model="status"
                    type="checkbox"
                    class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                >
                <span class="ml-2 text-sm text-gray-300">Activo</span>
            </label>
        </div>
        {{-- ======================= FIN: Información adicional ======================= --}}

        {{-- ======================= INICIO: Botones de acción ======================= --}}
        <div class="flex justify-end gap-4 pt-6 border-t border-gray-700">
            <a href="{{ route('inventario.index') }}"
                class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                Cancelar
            </a>
            <button type="submit"
                wire:loading.attr="disabled"
                wire:loading.class="opacity-50 cursor-not-allowed"
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex items-center gap-2">
                <span wire:loading.remove>Guardar Cambios</span>
                <span wire:loading>Guardando...</span>
                <div wire:loading class="animate-spin rounded-full h-4 w-4 border-b-2 border-white"></div>
            </button>
        </div>
        {{-- ======================= FIN: Botones de acción ======================= --}}
    </form>
    {{-- ======================= FIN: Formulario de Edición ======================= --}}

    {{-- ======================= INICIO: Modal de Usuarios ======================= --}}
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-gray-800 rounded-lg p-6 w-full max-w-2xl mx-4 max-h-[80vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-white">{{ $modalTitle }}</h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-white">
                        <x-lucide name="x" class="w-6 h-6" />
                    </button>
                </div>

                <div class="mb-4">
                    <input
                        wire:model.live="userSearch"
                        type="text"
                        placeholder="Buscar usuario..."
                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                </div>

                <div class="space-y-2 max-h-96 overflow-y-auto">
                    @foreach($users as $user)
                        <button
                            wire:click="selectUser({{ $user->id }}, '{{ $user->name }}')"
                            class="w-full p-3 text-left bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors">
                            <div class="text-white font-medium">{{ $user->name }}</div>
                            <div class="text-gray-400 text-sm">{{ $user->email }}</div>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    {{-- ======================= FIN: Modal de Usuarios ======================= --}}
</div>
{{-- ======================= FIN: Contenedor Principal ======================= --}}

