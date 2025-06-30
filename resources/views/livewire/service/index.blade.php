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
                    placeholder="Buscar servicios..." 
                    class="w-full pl-10 pr-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('servicios.create') }}"
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center gap-2 transition-colors" >
                <x-lucide name="plus" class="w-5 h-5" />
                Agregar Servicio
            </a>
        </div>
    </div>

    <!-- Tabla de servicios -->
    <div class="bg-gray-800 rounded-3xl overflow-hidden shadow-lg border border-gray-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700 rounded-3xl overflow-hidden">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-[8%] rounded-tl-3xl">
                            ID Servicio
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-[10%]">
                            Fecha de Servicio
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-[22%]">
                            Involucrados
                        </th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider w-[12%]">
                            Objetivo de la Solicitud
                        </th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider w-[12%]">
                            Actividades Realizadas
                        </th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider w-[12%]">
                            Observaciones
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-[8%]">
                            Estado
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-[5%] rounded-tr-3xl">
                            Acciones
                        </th>
                    </tr>
                </thead>
                
                <tbody class="bg-gray-700 divide-y divide-gray-600">
                    
                    @forelse($services as $service)
                        @php
                            $bgColor = 'bg-gray-700';
                            $hoverColor = 'hover:bg-gray-600';
                            
                            if ($service->status && $service->impressions) {
                                $bgColor = 'bg-black';
                                $hoverColor = 'hover:bg-gray-900';
                            } elseif ($service->status && !$service->impressions) {
                                $bgColor = 'bg-green-800';
                                $hoverColor = 'hover:bg-green-700';
                            }
                        @endphp
                        <tr class="{{ $bgColor }} {{ $hoverColor }} transition-colors">
                            <td class="px-3 py-4 text-sm text-gray-300 whitespace-nowrap">
                                id: {{ $service->id ?? 'N/A' }} <br> 
                                serv:{{ $service->id_s ?? 'N/A' }} <br> 
                                <span class="text-xs text-red-600"> {  <span  class="text-10px text-yellow-300"> {{ $this->NameQrCode($service->id_s) }}  </span>   } </span>
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-300 whitespace-nowrap">
                                {{ $service->F_serv ? $service->F_serv->format('d/m/Y') : 'N/A' }}
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-300">
                                <div class="space-y-1">
                                    @if($service->solicitante)
                                        <div class="text-xs text-gray-400">Solicitante:</div>
                                        <div class="font-medium text-white">{{ $service->solicitante->name }}</div>
                                    @endif
                                    @if($service->efectuo)
                                        <div class="text-xs text-gray-400">Efectuó:</div>
                                        <div class="font-medium text-white">{{ $service->efectuo->name }}</div>
                                    @endif
                                    @if($service->vobo)
                                        <div class="text-xs text-gray-400">VºBº:</div>
                                        <div class="font-medium text-white">{{ $service->vobo->name }}</div>
                                    @endif
                                    @if(!$service->solicitante && !$service->efectuo && !$service->vobo)
                                        <div class="text-gray-500">N/A</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-300">
                                <div class="text-center">
                                    <p class="font-medium text-white break-words">
                                        {!! $service->obj_sol ?? 'N/A' !!}
                                    </p>
                                </div>
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-300">
                                <div class="text-center">
                                    <p class="font-medium text-white break-words">
                                        {!! $service->actividades ?? 'N/A' !!}
                                    </p>
                                </div>
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-300">
                                <div class="text-center">
                                    <p class="font-medium text-white break-words">
                                        {!! $service->observaciones ?? 'N/A' !!}
                                    </p>
                                </div>
                            </td>
                            <td class="px-3 py-4 text-center">
                                @if($service->status)
                                    <button 
                                        wire:click="toggleStatus({{ $service->id }})"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 hover:bg-green-200 transition-colors cursor-pointer"
                                        title="Haz clic para desactivar"
                                    >
                                        Activo
                                    </button>
                                @else
                                    <button 
                                        wire:click="toggleStatus({{ $service->id }})"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-black hover:bg-gray-200 transition-colors cursor-pointer"
                                        title="Haz clic para activar"
                                    >
                                        Inactivo
                                    </button>
                                @endif
                            </td>
                            <td class="px-3 py-4">
                                <div class="flex items-center justify-center gap-1">
                                    <button 
                                        wire:click="editService({{ $service->id }})"
                                        class="text-blue-400 hover:text-blue-300 transition-colors"
                                        title="Editar"
                                    >
                                        <x-lucide name="edit" class="w-4 h-4" />
                                    </button>
                                    {{-- <button 
                                        wire:click="toggleStatus({{ $service->id }})"
                                        class="text-yellow-400 hover:text-yellow-300 transition-colors"
                                        title="{{ $service->status ? 'Desactivar' : 'Activar' }}"
                                    >
                                        <x-lucide name="toggle-left" class="w-4 h-4" />
                                    </button> --}}
                                    <button 
                                        wire:click="generateIndividualServiceReport({{ $service->id }})"
                                        class="text-orange-400 hover:text-red-500 transition-colors"
                                        title="Generar el Reporte del Servicio">
                                        <i class="ri-printer-line"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-3 py-12 text-center text-gray-400">
                                <x-lucide name="wrench" class="w-12 h-12 mx-auto mb-4 text-gray-600" />
                                <p class="text-lg">No se encontraron servicios</p>
                                <p class="text-sm">Comienza agregando un nuevo servicio</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Paginación -->
        @if($services->hasPages())
            <div class="px-3 py-4 bg-gray-700 border-t border-gray-600">
                {{ $services->links() }}
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
                        <select wire:model.defer="reportType" wire:blur="$refresh" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="general">Reporte General</option>
                            <option value="por_usuario">Por Usuario</option>
                            <option value="por_tipo">Por Tipo de Servicio</option>
                            <option value="por_fecha">Por Fecha</option>
                        </select>
                    </div>

                    <!-- Rango de Fechas -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Desde</label>
                            <input wire:model.defer="reportDateFrom" wire:blur="$refresh" type="date" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Hasta</label>
                            <input wire:model.defer="reportDateTo" wire:blur="$refresh" type="date" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Filtro por Usuario -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Usuario (Opcional)</label>
                        <select wire:model.defer="reportUser" wire:blur="$refresh" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Todos los usuarios</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtro por Estado -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Estado (Opcional)</label>
                        <select wire:model.defer="reportStatus" wire:blur="$refresh" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
            console.log('Livewire initialized');
            
            Livewire.on('download-report', (event) => {
                console.log('Download event received:', event);
                const url = event.url;
                console.log('Download URL:', url);
                
                const link = document.createElement('a');
                link.href = url;
                link.download = '';
                link.target = '_blank';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                
                console.log('Download link clicked');
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