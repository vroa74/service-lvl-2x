<div class="p-4">
    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
             class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex justify-between items-center">
            <span>{{ session('message') }}</span>
            <button @click="show = false" class="text-green-700 hover:text-green-900">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Mensaje de error -->
    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Acordeón con tabla de filtros -->
    <div x-data="{ open: true }" class="mb-6">
        <div class="bg-gray-800 rounded-3xl overflow-hidden shadow-lg border border-gray-700">
            <!-- Encabezado del acordeón -->
            <button @click="open = !open" class="w-full px-6 py-4 bg-gray-700 hover:bg-gray-600 transition-colors flex items-center justify-between" :class="{ 'rounded-b-3xl': !open && open === false }">
                <h3 class="text-lg font-medium text-white">Filtros de Inventario</h3>
                <svg class="w-5 h-5 text-gray-300 transform transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            
            <!-- Contenido del acordeón - Tabla de filtros -->
            <template x-if="open">
                <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="p-6">
                    <div class="overflow-x-auto rounded-3xl overflow-hidden">
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider bg-gray-700/50">
                                        Nombre / Resguardante
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider bg-gray-700/50">
                                        NI
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider bg-gray-700/50">
                                        Artículo
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider bg-gray-700/50">
                                        Estado
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider bg-gray-700/50">
                                        Ubicación
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800">
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="relative">
                                            <input 
                                                wire:model.live="generalSearch" 
                                                type="text" 
                                                placeholder="Buscar por nombre o resguardante..." 
                                                class="w-full pl-3 pr-10 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            >
                                            <button
                                                x-show="$wire.generalSearch"
                                                wire:click="$set('generalSearch', '')"
                                                type="button"
                                                class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-white transition-colors"
                                                aria-label="Limpiar búsqueda"
                                                x-cloak
                                            >
                                                <x-lucide name="x" class="w-4 h-4" />
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="relative">
                                            <input 
                                                wire:model.live="filterNi" 
                                                type="text" 
                                                placeholder="Buscar por NI..." 
                                                class="w-full pl-3 pr-10 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            >
                                            <button
                                                x-show="$wire.filterNi"
                                                wire:click="$set('filterNi', '')"
                                                type="button"
                                                class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-white transition-colors"
                                                aria-label="Limpiar búsqueda"
                                                x-cloak
                                            >
                                                <x-lucide name="x" class="w-4 h-4" />
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="relative">
                                            <input 
                                                wire:model.live="filterArticulo" 
                                                type="text" 
                                                placeholder="Buscar por artículo..." 
                                                class="w-full pl-3 pr-10 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            >
                                            <button
                                                x-show="$wire.filterArticulo"
                                                wire:click="$set('filterArticulo', '')"
                                                type="button"
                                                class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-white transition-colors"
                                                aria-label="Limpiar búsqueda"
                                                x-cloak
                                            >
                                                <x-lucide name="x" class="w-4 h-4" />
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <select wire:model.live="filterEstado" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="">Todos los estados</option>
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                        </select>
                                    </td>
                                    <td class="px-4 py-3">
                                        <select wire:model.live="filterUbicacion" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="">Todas las ubicaciones</option>
                                            @foreach($ubicaciones as $ubicacion)
                                                <option value="{{ $ubicacion }}">{{ $ubicacion }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="px-4 py-3">
                                        <div class="flex items-center justify-center gap-6">
                                            <!-- Checkbox para Usuario -->
                                            <label for="withUserId" class="flex items-center space-x-2 cursor-pointer">
                                                <input 
                                                    id="withUserId"
                                                    type="checkbox" 
                                                    wire:model.live="showWithUserId"
                                                    class="h-4 w-4 bg-gray-600 border-gray-500 text-blue-500 focus:ring-blue-500 rounded"
                                                >
                                                <span class="text-gray-300 text-sm">Con Usuario Asignado</span>
                                            </label>

                                            <!-- Checkbox para Resguardante -->
                                            <label for="withResId" class="flex items-center space-x-2 cursor-pointer">  
                                                <input 
                                                    id="withResId"
                                                    type="checkbox" 
                                                    wire:model.live="showWithResId"
                                                    class="h-4 w-4 bg-gray-600 border-gray-500 text-blue-500 focus:ring-blue-500 rounded"
                                                >
                                                <span class="text-gray-300 text-sm">Con Resguardante</span>
                                            </label>
                                            
                                            <!-- Botón para Marcar como PC -->
                                            <button
                                                type="button"
                                                @click="
                                                    Swal.fire({
                                                        title: '¿Estás seguro?',
                                                        text: 'Esta acción marcará todos los registros filtrados como PC. Esta acción no se puede deshacer.',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#D946EF',
                                                        cancelButtonColor: '#EF4444',
                                                        confirmButtonText: 'Sí, ¡marcar como PC!',
                                                        cancelButtonText: 'Cancelar'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            $wire.dispatch('confirmMarkAsPc');
                                                        }
                                                    })
                                                "
                                                class="px-4 py-2 bg-fuchsia-600 hover:bg-fuchsia-700 text-white rounded-lg transition-colors flex items-center gap-2"
                                            >
                                                <x-lucide name="laptop" class="w-4 h-4" />
                                                Es una computadora
                                            </button>
                                            <!-- is user-->
                                            <button                                                 
                                                class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-lg transition-colors flex items-center gap-2" >
                                                <x-lucide name="x" class="w-4 h-4" />
                                                Asignar a Usuario
                                            </button>

                                            <!-- Botón para Asignar Responsable -->
                                            <button
                                                type="button"
                                                @click="
                                                    Swal.fire({
                                                        title: '¿Asignar Responsable?',
                                                        text: 'Esto asignará el usuario filtrado como responsable de todos los registros de inventario filtrados. ¿Continuar?',
                                                        icon: 'question',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#10B981',
                                                        cancelButtonColor: '#EF4444',
                                                        confirmButtonText: 'Sí, ¡asignar!',
                                                        cancelButtonText: 'Cancelar'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            $wire.dispatch('confirmAssignResponsible');
                                                        }
                                                    })
                                                "
                                                class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-colors flex items-center gap-2"
                                            >
                                                <x-lucide name="user-check" class="w-4 h-4" />
                                                Asignar Responsable
                                            </button>

                                            <!-- Botón Limpiar Filtros -->
                                            <button 
                                                wire:click="clearFilters"
                                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors flex items-center gap-2"
                                            >
                                                <x-lucide name="x" class="w-4 h-4" />
                                                Limpiar Filtros
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Contenedor de las dos tablas lado a lado -->
    <div class="flex gap-4">
        <!-- Tabla de Usuarios (25% del ancho) -->
        <div class="w-1/4 flex flex-col">
            <div class="bg-gray-800 rounded-3xl overflow-hidden shadow-lg border border-gray-700 flex flex-col flex-1">
                <div class="px-4 py-3 bg-gray-700 border-b border-gray-600">
                    <h3 class="text-lg font-medium text-white">Usuarios</h3>
                </div>
                <div class="overflow-y-auto max-h-96 flex-1">
                    <table class="min-w-full border-2 border-gray-700 rounded-3xl">
                        <thead class="bg-gray-700/50 sticky top-0">
                            <tr class="rounded-3xl border-2 border-gray-700">
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    ID
                                </th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Nombre
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-700 transition-colors cursor-pointer {{ $selectedUserId == $user->id ? 'bg-blue-900/30' : '' }}"
                                    wire:click="selectUser({{ $user->id }})">
                                    <td class="px-3 py-2 text-sm text-gray-300">
                                        {{ $user->id }}
                                    </td>
                                    <td class="px-3 py-2 text-sm text-white font-medium">
                                        {{ $user->name }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-3 py-4 text-center text-gray-400">
                                        <x-lucide name="users" class="w-8 h-8 mx-auto mb-2 text-gray-600" />
                                        <p class="text-sm">No se encontraron usuarios</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Paginación de Usuarios -->
                @if($users->hasPages())
                    <div class="px-3 py-2 bg-gray-700 border-t border-gray-600">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Tabla de Inventario (75% del ancho) -->
        <div class="w-3/4 flex flex-col">
            <div class="bg-gray-800 rounded-3xl overflow-hidden shadow-lg border border-gray-700 flex flex-col flex-1">
                <div class="px-4 py-3 bg-gray-700 border-b border-gray-600">
                    <h3 class="text-lg font-medium text-white">
                        Inventario
                        @if($selectedUserId)
                            <span class="text-sm text-gray-400">- Usuario seleccionado</span>
                        @endif
                    </h3>
                </div>
                <div class="overflow-x-auto flex-1">
                    <table class="min-w-full">
                        <thead class="bg-gray-700/50 sticky top-0">
                            <tr>
                                <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Artículo
                                </th>
                                <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Detalles
                                </th>
                                <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Resguardante
                                </th>
                                <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Ubicación
                                </th>
                                <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Tipo
                                </th>
                                <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Estado
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @forelse($inventories as $item)
                                <tr class="hover:bg-gray-700 transition-colors">
                                    <td class="px-3 py-4 text-sm text-gray-300">
                                        <div class="font-medium text-white"> id:{{ $item->id ?? 'N/A' }}</div>
                                        <div class="font-medium text-white">{{ $item->articulo ?? 'N/A' }}</div>
                                        <div class="text-xs text-gray-400">NI: {{ $item->ni ?? 'N/A' }}</div>
                                        <div class="mt-2 space-y-1">
                                            <div><span class="font-semibold text-gray-400">NS:</span> {{ $item->ns ?? 'N/A' }}</div>
                                            <div><span class="font-semibold text-gray-400">Marca:</span> {{ $item->marca ?? 'N/A' }}</div>
                                            <div><span class="font-semibold text-gray-400">Modelo:</span> {{ $item->modelo ?? 'N/A' }}</div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4 text-sm text-gray-300">
                                        <div class="space-y-2">
                                            @if($item->user && is_object($item->user))
                                                <div>
                                                    <div class="text-xs text-gray-400">Usuario:</div>
                                                    <div class="font-medium text-white">{{ $item->user->name }}</div>
                                                    <div class="text-xs text-gray-500">{{ $item->user->position ?? 'Sin posición' }}</div>
                                                </div>
                                            @endif
                                            @if($item->responsible && is_object($item->responsible))
                                                <div>
                                                    <div class="text-xs text-gray-400">Resguardante:</div>
                                                    <div class="font-medium text-white">{{ $item->responsible->id }}</div>
                                                    <div class="font-medium text-white">{{ $item->responsible->name }}</div>
                                                    <div class="text-xs text-gray-500">{{ $item->responsible->position ?? 'Sin posición' }}</div>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-3 py-4 text-sm text-gray-300">
                                        <div class="font-medium text-white">{{ $item->resguardante ?? 'N/A' }}</div>
                                        <div class="text-xs text-gray-400">{{ $item->cargo ?? 'Sin cargo' }}</div>
                                    </td>
                                    <td class="px-3 py-4 text-sm text-gray-300">
                                        <div class="font-medium text-white">{{ $item->dir ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-3 py-4 text-center">                                      
                                        @if($item->is_pc)
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                PC
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                no es PC
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-4 text-sm">
                                        @if($item->status)
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Activo
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-black">
                                                Inactivo
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-3 py-12 text-center text-gray-400">
                                        <x-lucide name="database-zap" class="w-12 h-12 mx-auto mb-4 text-gray-600" />
                                        <p class="text-lg">
                                            @if($selectedUserId)
                                                No se encontraron artículos para este usuario
                                            @else
                                                Selecciona un usuario para ver su inventario
                                            @endif
                                        </p>
                                        <p class="text-sm">
                                            @if($selectedUserId)
                                                Este usuario no tiene artículos asignados
                                            @else
                                                Haz clic en un usuario de la lista
                                            @endif
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Paginación -->
                @if($inventories->hasPages())
                    <div class="px-3 py-4 bg-gray-700 border-t border-gray-600">
                        {{ $inventories->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@script
<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('swal:alert', (event) => {
            Swal.fire({
                icon: event.icon,
                title: event.title,
                text: event.text,
            });
        });
    });
</script>
@endscript 