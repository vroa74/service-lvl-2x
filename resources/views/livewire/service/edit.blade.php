<div>


    {{-- ======================= INICIO: Contenedor Principal ======================= --}}
    <div class="bg-gray-800 rounded-lg mb-1 shadow-xl w-full max-w-full px-8 mx-auto">
        {{-- ======================= INICIO: Header del formulario ======================= --}}
        <div class="p-1 border-b border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-white">
                    Editar Servicio
                </h3>
                <a href="{{ route('servicios.index') }}"
                    class="text-gray-400 hover:text-white transition-colors">
                    <x-lucide name="x" class="w-6 h-6" />
                </a>
            </div>
        </div>
        {{-- ======================= FIN: Header del formulario ======================= --}}

        {{-- ======================= INICIO: Mensajes de éxito y error ======================= --}}
        @if (session()->has('message'))
            <div class="p-4 mb-4 bg-green-600 border border-green-500 rounded-lg">
                <p class="text-white">{{ session('message') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 mb-4 bg-red-600 border border-red-500 rounded-lg">
                <ul class="text-white">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- ======================= FIN: Mensajes de éxito y error ======================= --}}

        {{-- ======================= INICIO: Formulario de Edición ======================= --}}
        <form wire:submit.prevent="saveService" class="p-6 space-y-6">
            {{-- ======================= INICIO: Información básica ======================= --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="id_s" class="block text-sm font-medium text-gray-300 mb-2">
                        ID Servicio
                    </label>
                    <input
                        wire:model="id_s"
                        type="text"
                        id="id_s"
                        readonly
                        class="w-full px-3 py-2 bg-gray-600 border border-gray-600 rounded-lg text-white placeholder-gray-400 cursor-not-allowed"
                        placeholder="ID del servicio">
                    @error('id_s') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="F_serv" class="block text-sm font-medium text-gray-300 mb-2">
                        Fecha de Servicio
                    </label>
                    <input
                        wire:model="F_serv"
                        type="date"
                        id="F_serv"
                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                    @error('F_serv') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            {{-- ======================= FIN: Información básica ======================= --}}

            {{-- ======================= INICIO: Descripción del servicio ======================= --}}
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <label for="obj_sol" class="block text-sm font-medium text-gray-300">
                        Objetivo de la Solicitud
                    </label>
                    <button
                        type="button"
                        wire:click="openUserModal('objetivo', 'null', 'null', null, 'null')"
                        class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors flex items-center gap-1">
                        <x-lucide name="users" class="w-4 h-4" />
                    </button>
                    <!-- Botón para abrir el modal de inventario -->
                    <button
                        type="button"
                        wire:click="openInventoryModal('objetivo')"
                        class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg transition-colors flex items-center gap-1">
                        <x-lucide name="list-search" class="w-4 h-4" />
                    </button>
                    <!-- Botón de prueba temporal -->
                    <button
                        type="button"
                        wire:click="testUpdateObjSol"
                        class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg transition-colors flex items-center gap-1">
                        TEST
                    </button>
                </div>
                <textarea
                    wire:model.defer="obj_sol"
                    wire:blur="$refresh"
                    id="obj_sol"
                    rows="3"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Describa el objetivo de la solicitud"
                ></textarea>
                @error('obj_sol') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror

            </div>
            {{-- ======================= FIN: Descripción del servicio ======================= --}}

            {{-- ======================= INICIO: Actividades y Observaciones ======================= --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <label for="actividades" class="block text-sm font-medium text-gray-300 mb-2">
                            Actividades Realizadas
                        </label>
                        <button
                            type="button"
                            wire:click="openUserModal('actividades', 'null', 'null', null, 'null')"
                            class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors flex items-center gap-1">
                            <x-lucide name="users" class="w-4 h-4" />
                        </button>
                        <!-- Botón para abrir el modal de inventario -->
                        <button
                            type="button"
                            wire:click="openInventoryModal('actividades')"
                            class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg transition-colors flex items-center gap-1">
                            <x-lucide name="list-search" class="w-4 h-4" />
                        </button>
                    </div>
                    <textarea
                        wire:model.defer="actividades"
                        wire:blur="$refresh"
                        id="actividades"
                        rows="3"
                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Describa las actividades realizadas"
                    ></textarea>
                    @error('actividades') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <label for="observaciones" class="block text-sm font-medium text-gray-300 mb-2">
                            Observaciones
                        </label>
                        <button
                            type="button"
                            wire:click="openUserModal('observaciones', 'null', 'null', null, 'null')"
                            class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors flex items-center gap-1">
                            <x-lucide name="users" class="w-4 h-4" />
                        </button>
                        <!-- Botón para abrir el modal de inventario -->
                        <button
                            type="button"
                            wire:click="openInventoryModal('observaciones')"
                            class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg transition-colors flex items-center gap-1">
                            <x-lucide name="list-search" class="w-4 h-4" />
                        </button>
                    </div>
                    <textarea
                        wire:model.defer="observaciones"
                        wire:blur="$refresh"
                        id="observaciones"
                        rows="3"
                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Observaciones adicionales"
                    ></textarea>
                    @error('observaciones') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            {{-- ======================= FIN: Actividades y Observaciones ======================= --}}

            {{-- ======================= INICIO: Tipo de Servicio y Via de Solicitud ======================= --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tipo de servicio -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-3">
                        Tipo de Servicio
                    </label>
                    <div class="flex flex-wrap gap-3 items-center">
                        <label class="flex items-center">
                            <input
                                wire:model="correctivo"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                            >
                            <span class="ml-2 text-sm text-gray-300">Correctivo</span>
                        </label>
                        <label class="flex items-center">
                            <input
                                wire:model="preventivo"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                            >
                            <span class="ml-2 text-sm text-gray-300">Preventivo</span>
                        </label>
                        <label class="flex items-center">
                            <input
                                wire:model="transparencia"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                            >
                            <span class="ml-2 text-sm text-gray-300">Transparencia</span>
                        </label>
                        <label class="flex items-center">
                            <input
                                wire:model="a_tec"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                            >
                            <span class="ml-2 text-sm text-gray-300">A. Técnico</span>
                        </label>
                        <label class="flex items-center">
                            <input
                                wire:model="web_ins"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                            >
                            <span class="ml-2 text-sm text-gray-300">Web/Ins</span>
                        </label>
                        <label class="flex items-center">
                            <input
                                wire:model="print"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                            >
                            <span class="ml-2 text-sm text-gray-300">Print</span>
                        </label>
                    </div>
                    @error('tipo_servicio')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Via de solicitud -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-3">
                        Via de Solicitud
                    </label>
                    <div class="flex flex-wrap gap-3 items-center">
                        <label class="flex items-center">
                            <input
                                wire:model="email"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                            >
                            <span class="ml-2 text-sm text-gray-300">Email</span>
                        </label>
                        <label class="flex items-center">
                            <input
                                wire:model="tel"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                            >
                            <span class="ml-2 text-sm text-gray-300">Teléfono</span>
                        </label>
                        <label class="flex items-center">
                            <input
                                wire:model="sol_ser"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                            >
                            <span class="ml-2 text-sm text-gray-300">Solicitud de Servicio</span>
                        </label>
                        <label class="flex items-center">
                            <input
                                wire:model="oficio"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                            >
                            <span class="ml-2 text-sm text-gray-300">Oficio</span>
                        </label>
                        <label class="flex items-center">
                            <input
                                wire:model.live="calendario"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                            >
                            <span class="ml-2 text-sm text-gray-300">Calendario</span>
                        </label>
                    </div>
                    @error('via_solicitud')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- ======================= FIN: Tipo de Servicio y Via de Solicitud ======================= --}}

            {{-- ======================= INICIO: Mantenimiento (condicional) ======================= --}}
            @if($calendario)
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <label for="observaciones" class="block text-sm font-medium text-gray-300 mb-2">
                        Mantenimiento
                    </label>
                    <button
                        type="button"
                        wire:click="openUserModal('mantenimiento', 'null', 'null', null, 'null')"
                        class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors flex items-center gap-1">
                        <x-lucide name="users" class="w-4 h-4" />
                    </button>
                    <!-- Botón para abrir el modal de inventario -->
                    <button
                        type="button"
                        wire:click="openInventoryModal('mantenimiento')"
                        class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg transition-colors flex items-center gap-1">
                        <x-lucide name="list-search" class="w-4 h-4" />
                    </button>
                </div>
                <textarea
                    wire:model.defer="mantenimiento"
                    wire:blur="$refresh"
                    id="mantenimiento"
                    rows="2"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Detalles de mantenimiento"
                ></textarea>
                @error('mantenimiento') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            @endif
            {{-- ======================= FIN: Mantenimiento (condicional) ======================= --}}

            {{-- ======================= INICIO: Usuarios involucrados ======================= --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-3">
                    Usuarios Involucrados
                </label>
                <!-- Tabla de 3 columnas para Solicitante, Efectuó y VºBº -->
                <div class="w-full flex gap-2 mb-6">
                    <div class="flex-1 bg-gray-700 rounded-lg p-4 text-center">
                        <div class="font-semibold text-gray-200 mb-2 flex flex-col items-center justify-center">
                            <div class="flex items-center gap-2">
                                <label for="obj_sol" class="block text-sm font-medium text-gray-300">
                                    Solicitante
                                </label>
                                <button
                                    type="button"
                                    wire:click="openUserModal('Solicitante', 'null', 'null', null, 'null')"
                                    class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors flex items-center gap-1">
                                    <x-lucide name="users" class="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                        <div class="text-gray-400">
                            {{ $solicitante_name }}
                            {{ $solicitante_position }}
                            {{ $solicitante_direction }}
                            @error('solicitante_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="flex-1 bg-gray-700 rounded-lg p-4 text-center">
                        <div class="font-semibold text-gray-200 mb-2 flex flex-col items-center justify-center">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-medium text-gray-300">
                                    Efectuó
                                </label>
                                <button
                                    type="button"                                
                                    wire:click="openUserModal('efectuo', 'null', 'infor', null, 'null')"
                                    class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors flex items-center gap-1">
                                    <x-lucide name="users" class="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                        <div class="text-gray-400">
                            {{ $efectuo_name }}
                            {{ $efectuo_position }}
                            {{ $efectuo_direction }}
                            @error('efectuo_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="flex-1 bg-gray-700 rounded-lg p-4 text-center">
                        <div class="font-semibold text-gray-200 mb-2 flex flex-col items-center justify-center">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-medium text-gray-300">
                                    VºBº
                                </label>
                                <button
                                    type="button"
                                    wire:click="openUserModal('vobo', 'null', 'infor', 4, 'null')"
                                    class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors flex items-center gap-1">
                                    <x-lucide name="users" class="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                        <div class="text-gray-400">
                            {{ $vobo_name }}
                            {{ $vobo_position }}
                            {{ $vobo_direction }}
                            @error('vobo_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            {{-- ======================= FIN: Usuarios involucrados ======================= --}}

            {{-- ======================= INICIO: Botones de acción ======================= --}}
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-700">
                <a href="{{ route('servicios.index') }}"
                    class="px-4 py-2 text-gray-300 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors"
                >
                    Cancelar
                </a>
                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex items-center gap-2"
                >
                    <x-lucide name="save" class="w-4 h-4" />
                    Guardar Edición Servicio
                </button>
            </div>
            {{-- ======================= FIN: Botones de acción ======================= --}}
        </form>
        {{-- ======================= FIN: Formulario de Edición ======================= --}}

        {{-- ======================= INICIO: Modal de Selección de Usuario ======================= --}}
        @if($showModal)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                <div class="bg-gray-800 rounded-lg shadow-xl w-full max-w-full max-h-[90vh] overflow-y-auto">
                    <div class="p-6 border-b border-gray-700">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-white">
                                Selección de Usuario
                                <div class="text-xs text-gray-400 font-normal mt-1">
                                    {{ $modalType ?? '' }},
                                    {{ $modalParam1 ?? '' }},
                                    {{ $modalParam2 ?? '' }},
                                    {{ $modalParam4 ?? '' }},
                                </div>
                            </h3>
                            <button
                                wire:click="closeModal"
                                class="text-gray-400 hover:text-white transition-colors"
                            >
                                <x-lucide name="x" class="w-6 h-6" />
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <!-- Campos de búsqueda -->
                        <div class="mb-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">
                                        Buscar por Nombre
                                    </label>
                                    <input
                                        wire:model.live="userSearchName"
                                        type="text"
                                        placeholder="Nombre..."
                                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    >
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">
                                        Buscar por Posición
                                    </label>
                                    <input
                                        wire:model.live="userSearchPosition"
                                        type="text"
                                        placeholder="Posición..."
                                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    >
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">
                                        Buscar por Dirección
                                    </label>
                                    <input
                                        wire:model.live="userSearchDirection"
                                        type="text"
                                        placeholder="Dirección..."
                                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    >
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">
                                        Buscar por Nivel
                                    </label>
                                    <input
                                        wire:model.live="userSearchLvl"
                                        type="text"
                                        placeholder="Nivel..."
                                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    >
                                </div>
                            </div>
                        </div>
                        <!-- Tabla de usuarios -->
                        <div class="bg-gray-700 rounded-3xl overflow-hidden border border-gray-600">
                            <div class="overflow-x-auto">
                                <table class="w-full rounded-3xl overflow-hidden">
                                    <thead class="bg-gray-600">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider text-xs rounded-tl-3xl">
                                                Nombre
                                            </th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider text-xs">
                                                RFC
                                            </th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider text-xs">
                                                Posición
                                            </th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider text-xs">
                                                Dirección
                                            </th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider text-xs">
                                                Sexo
                                            </th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider text-xs">
                                                Tipo
                                            </th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider text-xs">
                                                Nivel
                                            </th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider text-xs rounded-tr-3xl">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-700 divide-y divide-gray-600">
                                        @forelse($filteredUsers as $user)
                                        {{-- para que el el regitro del modal pueda funciona es obligatori usar el wire:key --}}
                                            <tr wire:key="user-{{ $user->id }}" class="hover:bg-gray-600 transition-colors">
                                                <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-300">
                                                    <div class="font-medium text-white text-xs">{{ $user->name }}</div>
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-300">
                                                    {{ $user->rfc ?? 'N/A' }}
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-300">
                                                    {{ $user->position ?? 'N/A' }}
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-300">
                                                    {{ $user->direction ?? 'N/A' }}
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-300">
                                                    {{ $user->sex ?? 'N/A' }}
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-300">
                                                    {{ $user->tipo ?? 'N/A' }}
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-300">
                                                    {{ $user->lvl ?? 'N/A' }}
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap text-xs font-medium">
                                                    <button
                                                        wire:click="selectUser({{ $user->id }}, @js($user->name))"
                                                        class="text-blue-400 hover:text-blue-300 transition-colors"
                                                        title="Seleccionar" >
                                                        <x-lucide name="check" class="w-4 h-4" />
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="px-6 py-12 text-center text-gray-400">
                                                    <x-lucide name="user-x" class="w-12 h-12 mx-auto mb-4 text-gray-600" />
                                                    <p class="text-lg">No se encontraron usuarios</p>
                                                    <p class="text-sm">Intenta con otros términos de búsqueda</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Botones del modal -->
                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-700 mt-4">
                            <button
                                type="button"
                                wire:click="closeModal"
                                class="px-4 py-2 text-gray-300 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors"
                            >
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- ======================= FIN: Modal de Selección de Usuario ======================= --}}

        {{-- ======================= INICIO: Modal de Selección de Inventario ======================= --}}
        @if($showInventoryModal)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                <div class="bg-gray-800 rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] overflow-y-auto">
                    <div class="p-6 border-b border-gray-700">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-white">
                                Selección de Inventario
                                <div class="text-xs text-gray-400 font-normal mt-1">
                                    {{ $inventoryModalType ?? '' }},
                                    {{ $inventoryParam1 ?? '' }},
                                    {{ $inventoryParam2 ?? '' }},
                                    {{ $inventoryParam3 ?? '' }},
                                    {{ $inventoryParam4 ?? '' }},
                                    {{ $inventoryParam5 ?? '' }},
                                </div>
                            </h3>
                            <button
                                wire:click="closeInventoryModal"
                                class="text-gray-400 hover:text-white transition-colors"
                            >
                                <x-lucide name="x" class="w-6 h-6" />
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <!-- Campos de búsqueda para inventario -->
                        <div class="mb-4">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">
                                        Buscar por NI
                                    </label>
                                    <input
                                        wire:model.live="inventorySearchNi"
                                        type="text"
                                        placeholder="NI..."
                                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    >
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">
                                        Buscar por SN
                                    </label>
                                    <input
                                        wire:model.live="inventorySearchSn"
                                        type="text"
                                        placeholder="SN..."
                                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    >
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">
                                        Buscar por TYPE
                                    </label>
                                    <input
                                        wire:model.live="inventorySearchType"
                                        type="text"
                                        placeholder="TYPE..."
                                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    >
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">
                                        Buscar por ARTICULO
                                    </label>
                                    <input
                                        wire:model.live="inventorySearchArticulo"
                                        type="text"
                                        placeholder="ARTICULO..."
                                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    >
                                </div>
                            </div>
                        </div>
                        <!-- Tabla de inventarios -->
                        <div class="bg-gray-700 rounded-3xl overflow-hidden border border-gray-600">
                            <div class="overflow-x-auto">
                                <table class="w-full rounded-3xl overflow-hidden">
                                    <thead class="bg-gray-600">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider rounded-tl-3xl">NI</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">SN</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">TYPE</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">ARTICULO</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider rounded-tr-3xl">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-700 divide-y divide-gray-600">
                                        @forelse($filteredInventories as $inv)
                                        <tr wire:key="inv-{{ $inv->id }}" class="hover:bg-gray-600 transition-colors">
                                            <tr >
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-300">{{ $inv->ni ?? 'N/A' }}</td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-300">{{ $inv->ns ?? 'N/A' }}</td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-300">{{ $inv->type ?? 'N/A' }}</td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-300">{{ $inv->articulo ?? 'N/A' }}</td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                                    <button
                                                        wire:click="selectInventory({{ $inv->id }})"
                                                        class="text-green-400 hover:text-green-300 transition-colors"
                                                        title="Seleccionar"
                                                    >
                                                        <x-lucide name="check" class="w-4 h-4" />
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                                    <x-lucide name="package-x" class="w-12 h-12 mx-auto mb-4 text-gray-600" />
                                                    <p class="text-lg">No se encontraron inventarios</p>
                                                    <p class="text-sm">Intenta con otros términos de búsqueda</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Botones del modal -->
                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-700 mt-4">
                            <button
                                type="button"
                                wire:click="closeInventoryModal"
                                class="px-4 py-2 text-gray-300 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors"
                            >
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- ======================= FIN: Modal de Selección de Inventario ======================= --}}

        {{-- ======================= INICIO: Scripts Livewire ======================= --}}
        @livewireStyles
        @livewireScripts
        {{-- ======================= FIN: Scripts Livewire ======================= --}}

        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('update-textarea', (event) => {
                    const field = event.field;
                    const value = event.value;
                    const textarea = document.getElementById(field);
                    if (textarea) {
                        textarea.value = value;
                        // Disparar evento para que Livewire detecte el cambio
                        textarea.dispatchEvent(new Event('input', { bubbles: true }));
                    }
                });
            });
        </script>
    </div>
    {{-- ======================= FIN: Contenedor Principal ======================= --}}

</div>

