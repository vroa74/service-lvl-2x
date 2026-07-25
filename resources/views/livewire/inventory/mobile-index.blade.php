<div class="p-2 sm:p-4">
    <!-- Header móvil con información del dispositivo -->
    <div class="mb-4 p-3 bg-blue-900 rounded-lg text-white text-center">
        <h1 class="text-lg font-bold">📱 Inventario Móvil</h1>
        <p class="text-xs text-blue-200">Dispositivo: {{ $deviceType }}</p>
    </div>

    <!-- Filtros móviles colapsables -->
    <div x-data="{ open: false }" class="mb-4">
        <button @click="open = !open"
            class="w-full flex items-center justify-between bg-blue-800 text-white px-4 py-3 rounded-lg">
            <span class="font-semibold">🔍 Filtros</span>
            <svg :class="{ 'rotate-180': open }" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        
        <div x-show="open" x-transition class="mt-2 bg-gray-800 rounded-lg p-3 space-y-3">
            <!-- Búsqueda principal -->
            <div class="relative">
                <input wire:model.live="search" type="text" placeholder="🔍 Buscar artículo, NI, NS..."
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 text-sm">
            </div>
            
            <!-- Filtros en grid móvil -->
            <div class="grid grid-cols-2 gap-2">
                <input wire:model.live="filterNi" type="text" placeholder="NI"
                    class="px-2 py-1 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 text-xs">
                <input wire:model.live="filterNs" type="text" placeholder="NS"
                    class="px-2 py-1 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 text-xs">
                <input wire:model.live="filterArticulo" type="text" placeholder="Artículo"
                    class="px-2 py-1 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 text-xs">
                <input wire:model.live="filterMarca" type="text" placeholder="Marca"
                    class="px-2 py-1 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 text-xs">
            </div>
            
            <!-- Selects -->
            <div class="grid grid-cols-2 gap-2">
                <select wire:model.live="filterFechaInv" class="px-2 py-1 bg-gray-700 border border-gray-600 rounded text-white text-xs">
                    <option value="">Todas las fechas</option>
                    @foreach ($uniqueFechasInv as $fecha)
                        <option value="{{ $fecha }}">{{ $fecha }}</option>
                    @endforeach
                </select>
                <select wire:model.live="perPage" class="px-2 py-1 bg-gray-700 border border-gray-600 rounded text-white text-xs">
                    <option value="10">10 items</option>
                    <option value="25">25 items</option>
                    <option value="50">50 items</option>
                </select>
            </div>
            
            <!-- Contador -->
            <div class="text-center p-2 bg-yellow-900 rounded text-yellow-200 text-sm font-bold">
                {{ $inventories->total() }} artículos
            </div>
        </div>
    </div>

    <!-- Mensajes de estado -->
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="mb-3 p-3 bg-green-800 border border-green-600 text-green-200 rounded-lg text-sm">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-3 p-3 bg-red-800 border border-red-600 text-red-200 rounded-lg text-sm">
            {{ session('error') }}
        </div>
    @endif

    <!-- Botones de acción móviles -->
    <div class="flex gap-2 mb-4 overflow-x-auto pb-2">
        <a href="{{ route('inventory.user-inv') }}"
            class="flex-shrink-0 px-4 py-2 bg-purple-600 text-white rounded-lg text-sm font-medium">
            👥 Usuarios
        </a>
        <a href="{{ route('inventario.create') }}"
            class="flex-shrink-0 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium">
            ➕ Agregar
        </a>
        <button wire:click="openReportModal('general')"
            class="flex-shrink-0 px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium">
            📊 Reportes
        </button>
    </div>

    <!-- Lista de inventario móvil -->
    <div class="space-y-3">
        @forelse($inventories as $item)
            <div class="bg-gray-800 rounded-lg p-3 border border-gray-700">
                <!-- Header del item -->
                <div class="flex justify-between items-start mb-2">
                    <div class="flex-1">
                        <h3 class="font-bold text-white text-sm">{{ $item->articulo ?? 'N/A' }}</h3>
                        <p class="text-gray-400 text-xs">NI: {{ $item->ni ?? 'N/A' }}</p>
                    </div>
                    <div class="flex gap-1">
                        @if ($item->is_pc)
                            <span class="px-2 py-1 bg-blue-600 text-white text-xs rounded-full">PC</span>
                        @else
                            <span class="px-2 py-1 bg-gray-600 text-white text-xs rounded-full">Otro</span>
                        @endif
                        <button wire:click="toggleStatus({{ $item->id }})"
                            class="px-2 py-1 {{ $item->status ? 'bg-green-600' : 'bg-gray-600' }} text-white text-xs rounded-full">
                            {{ $item->status ? '✅' : '❌' }}
                        </button>
                    </div>
                </div>

                <!-- Detalles del item -->
                <div class="grid grid-cols-2 gap-2 text-xs mb-3">
                    <div>
                        <span class="text-gray-400">NS:</span>
                        <span class="text-white">{{ $item->ns ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400">Marca:</span>
                        <span class="text-white">{{ $item->marca ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400">Modelo:</span>
                        <span class="text-white">{{ $item->modelo ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Usuarios -->
                <div class="mb-3">
                    @if ($item->assignedUser)
                        <div class="text-xs">
                            <span class="text-yellow-400">👤 Usuario:</span>
                            <span class="text-white">{{ $item->assignedUser->name ?? 'N/A' }}</span>
                        </div>
                    @endif
                    @if ($item->responsible)
                        <div class="text-xs">
                            <span class="text-pink-400">🛡️ Resguardante:</span>
                            <span class="text-white">{{ $item->responsible->name ?? 'N/A' }}</span>
                        </div>
                    @endif
                </div>

                <!-- Botones de acción -->
                <div class="flex gap-2">
                    <button wire:click="editInventory({{ $item->id }})"
                        class="flex-1 px-3 py-2 bg-blue-600 text-white rounded text-xs font-medium">
                        ✏️ Editar
                    </button>
                    <button wire:click="generateIndividualInventoryReport({{ $item->id }})"
                        class="flex-1 px-3 py-2 bg-orange-600 text-white rounded text-xs font-medium">
                        📄 Reporte
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center py-8">
                <div class="text-gray-400 text-4xl mb-2">📱</div>
                <p class="text-gray-400 text-sm">No se encontraron artículos</p>
                <p class="text-gray-500 text-xs">Usa los filtros o agrega un nuevo artículo</p>
            </div>
        @endforelse
    </div>

    <!-- Paginación móvil -->
    @if ($inventories->hasPages())
        <div class="mt-4 flex justify-center">
            <div class="bg-gray-800 rounded-lg p-2">
                {{ $inventories->links() }}
            </div>
        </div>
    @endif

    <!-- Modal de Reportes optimizado para móvil -->
    @if ($showReportModal)
        <div class="fixed inset-0 bg-black bg-opacity-75 flex items-end sm:items-center justify-center z-50 p-4">
            <div class="bg-gray-800 rounded-lg w-full max-w-sm max-h-[90vh] overflow-y-auto">
                <div class="sticky top-0 bg-gray-800 p-4 border-b border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-white">📊 Generar Reporte</h3>
                        <button wire:click="closeReportModal" class="text-gray-400 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="generateReport" class="p-4 space-y-4">
                    <!-- Tipo de Reporte -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Tipo de Reporte</label>
                        <select wire:model="reportType"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white text-sm">
                            <option value="general">📋 Reporte General</option>
                            <option value="por_usuario">👥 Por Usuario</option>
                            <option value="por_tipo">📱 Por Tipo</option>
                            <option value="por_fecha">📅 Por Fecha</option>
                        </select>
                    </div>

                    <!-- Rango de Fechas -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Desde</label>
                        <input wire:model="reportDateFrom" type="date"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white text-sm">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Hasta</label>
                        <input wire:model="reportDateTo" type="date"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white text-sm">
                    </div>

                    <!-- Filtro por Usuario -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Usuario (Opcional)</label>
                        <select wire:model="reportUser"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white text-sm">
                            <option value="">👥 Todos los usuarios</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtro por Estado -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Estado (Opcional)</label>
                        <select wire:model="reportStatus"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white text-sm">
                            <option value="">🔄 Todos los estados</option>
                            <option value="1">✅ Activo</option>
                            <option value="0">❌ Inactivo</option>
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-3 pt-4">
                        <button type="button" wire:click="closeReportModal"
                            class="flex-1 px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg text-sm">
                            ❌ Cancelar
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm">
                            📥 Generar PDF
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Scripts optimizados para móvil -->
    <script>
        document.addEventListener('livewire:init', () => {
            // Optimizaciones para móvil
            if (window.innerWidth <= 768) {
                // Reducir animaciones
                document.body.style.setProperty('--tw-transition-duration', '0.1s');
                
                // Mejorar scroll
                document.body.style.webkitOverflowScrolling = 'touch';
                
                // Optimizar inputs para móvil
                const inputs = document.querySelectorAll('input, textarea, select');
                inputs.forEach(input => {
                    input.style.fontSize = '16px'; // Evita zoom en iOS
                    input.style.touchAction = 'manipulation';
                });
            }

            // Eventos Livewire
            Livewire.on('download-report', (event) => {
                const url = event.url;
                const link = document.createElement('a');
                link.href = url;
                link.download = '';
                link.target = '_blank';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });

            Livewire.on('openPdfInNewTab', (event) => {
                window.open(event.url, '_blank');
            });
        });

        // Optimizaciones adicionales para móvil
        if ('ontouchstart' in window) {
            // Mejorar experiencia táctil
            document.addEventListener('touchstart', function() {}, {passive: true});
            
            // Prevenir zoom en inputs
            document.addEventListener('gesturestart', function(e) {
                e.preventDefault();
            });
        }
    </script>

    <!-- Estilos específicos para móvil -->
    <style>
        @media (max-width: 768px) {
            /* Reducir padding y márgenes */
            .p-4 { padding: 0.5rem; }
            .mb-4 { margin-bottom: 0.75rem; }
            
            /* Optimizar botones para touch */
            button, a {
                min-height: 44px; /* Tamaño mínimo recomendado para touch */
                touch-action: manipulation;
            }
            
            /* Mejorar scroll */
            .overflow-x-auto {
                -webkit-overflow-scrolling: touch;
                scroll-behavior: smooth;
            }
            
            /* Optimizar modales */
            .fixed {
                padding: 0.5rem;
            }
            
            /* Reducir animaciones */
            * {
                transition-duration: 0.1s !important;
            }
        }
        
        /* Soporte para notch */
        @supports (padding: max(0px)) {
            .p-2 {
                padding-left: max(0.5rem, env(safe-area-inset-left));
                padding-right: max(0.5rem, env(safe-area-inset-right));
            }
        }
    </style>
</div> 