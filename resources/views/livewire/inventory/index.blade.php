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

    <!-- Barra de búsqueda y botones -->
    <div class="flex flex-col sm:flex-row gap-4 mb-4">
        <div class="flex-1">
            <div class="relative">
                <x-lucide name="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" />
                <input 
                    wire:model.live="search" 
                    type="text" 
                    placeholder="Buscar artículo, NI, NS, marca..." 
                    class="w-full pl-10 pr-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
            </div>
        </div>
        <div class="flex gap-2">
            <a 
                href="{{ route('inventory.user-inv') }}"
                class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg flex items-center gap-2 transition-colors"
                title="Ver inventario por usuario">
                <x-lucide name="users" class="w-5 h-5" />
                Por Usuario
            </a>
            {{-- <button 
                wire:click="openReportModal('general')"
                class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg flex items-center gap-2 transition-colors"
                title="Generar Reporte">
                <x-lucide name="file-text" class="w-5 h-5" />
                Reportes
            </button> --}}
            <a href="{{ route('inventario.create') }}"
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center gap-2 transition-colors">
                <x-lucide name="plus" class="w-5 h-5" />
                Agregar Artículo
            </a>
        </div>
    </div>

    <!-- Tabla de inventario -->
    <div class="bg-gray-800 rounded-3xl overflow-hidden shadow-lg border border-gray-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700 rounded-3xl overflow-hidden">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-[15%] rounded-tl-3xl">
                            Artículo
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-[15%]">
                            Detalles
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-[20%]">
                            Resguardante
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-[15%]">
                            Ubicación
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-[10%]">
                            Tipo
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-[10%]">
                            Estado
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-[15%] rounded-tr-3xl">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    @forelse($inventories as $item)
                        <tr class="hover:bg-gray-700 transition-colors">
                            <td class="px-3 py-4 text-sm text-gray-300">
                                <div class="font-medium text-white">{{ $item->articulo ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-400">NI: {{ $item->ni ?? 'N/A' }}</div>
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-300">
                                <div class="space-y-1">
                                    <div><span class="font-semibold">NS:</span> {{ $item->ns ?? 'N/A' }}</div>
                                    <div><span class="font-semibold">Marca:</span> {{ $item->marca ?? 'N/A' }}</div>
                                    <div><span class="font-semibold">Modelo:</span> {{ $item->modelo ?? 'N/A' }}</div>
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
                                        Otro
                                    </span>
                                @endif
                            </td>
                            <td class="px-3 py-4 text-center">
                                @if($item->status)
                                    <button 
                                        wire:click="toggleStatus({{ $item->id }})"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 hover:bg-green-200 transition-colors cursor-pointer"
                                        title="Haz clic para desactivar">
                                        Activo
                                    </button>
                                @else
                                    <button 
                                        wire:click="toggleStatus({{ $item->id }})"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-black hover:bg-gray-200 transition-colors cursor-pointer"
                                        title="Haz clic para activar">
                                        Inactivo
                                    </button>
                                @endif
                            </td>
                            <td class="px-3 py-4">
                                <div class="flex items-center justify-center gap-1">
                                    <button 
                                        wire:click="editInventory({{ $item->id }})"
                                        class="text-blue-400 hover:text-blue-300 transition-colors"
                                        title="Editar">
                                        <x-lucide name="edit" class="w-4 h-4" />
                                    </button>
                                    <button 
                                        wire:click="openReportModal('general')"
                                        class="text-green-400 hover:text-green-300 transition-colors"
                                        title="Generar Reporte">
                                        <i class="ri-printer-line"></i>
                                    </button>
                                    <button 
                                        wire:click="toggleStatus({{ $item->id }})"
                                        class="text-yellow-400 hover:text-yellow-300 transition-colors"
                                        title="{{ $item->status ? 'Desactivar' : 'Activar' }}">
                                        <x-lucide name="toggle-left" class="w-4 h-4" />
                                    </button>
                                    <button 
                                        wire:click="generateIndividualInventoryReport({{ $item->id }})"
                                        class="text-orange-400 hover:text-red-500 transition-colors"
                                        title="Generar el Reporte del Artículo">
                                        <i class="ri-printer-line"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-3 py-12 text-center text-gray-400">
                                <x-lucide name="database-zap" class="w-12 h-12 mx-auto mb-4 text-gray-600" />
                                <p class="text-lg">No se encontraron artículos en el inventario</p>
                                <p class="text-sm">Comienza agregando un nuevo artículo</p>
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

    <!-- Modal de Reportes -->
    @if($showReportModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-gray-800 rounded-lg p-6 w-full max-w-md mx-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-white">Generar Reporte</h3>
                    <button wire:click="closeReportModal" class="text-gray-400 hover:text-white">
                        <x-lucide name="x" class="w-6 h-6" />
                    </button>
                </div>

                <form wire:submit.prevent="generateReport" class="space-y-4">
                    <!-- Tipo de Reporte -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Tipo de Reporte</label>
                        <select wire:model="reportType" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="general">Reporte General</option>
                            <option value="por_usuario">Por Usuario</option>
                            <option value="por_tipo">Por Tipo de Artículo</option>
                            <option value="por_fecha">Por Fecha</option>
                        </select>
                    </div>

                    <!-- Rango de Fechas -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Desde</label>
                            <input wire:model="reportDateFrom" type="date" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Hasta</label>
                            <input wire:model="reportDateTo" type="date" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Filtro por Usuario -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Usuario (Opcional)</label>
                        <select wire:model="reportUser" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Todos los usuarios</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtro por Estado -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Estado (Opcional)</label>
                        <select wire:model="reportStatus" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Todos los estados</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-3 pt-4">
                        <button type="button" wire:click="closeReportModal" class="flex-1 px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                            Cancelar
                        </button>
                        <button type="submit" class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors flex items-center justify-center gap-2">
                            <x-lucide name="download" class="w-4 h-4" />
                            Generar PDF
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Script para manejar la descarga -->
    <script>
        document.addEventListener('livewire:init', () => {
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
        });
    </script>

    <!-- Scripts para abrir PDF en nueva pestaña -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('openPdfInNewTab', (event) => {
                window.open(event.url, '_blank');
            });
        });
    </script>
</div> 