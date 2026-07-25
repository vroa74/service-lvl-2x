<!-- Modal de Selección de Inventario -->
@if ($showInventoryModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-2 sm:p-4">
        <div class="bg-gray-800 rounded-lg shadow-xl w-full max-w-7xl max-h-[90vh] overflow-y-auto">
            <div class="p-4 sm:p-6 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-base sm:text-lg font-medium text-white">
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
                    <button wire:click="closeInventoryModal" class="text-gray-400 hover:text-white transition-colors">
                        <x-lucide name="x" class="w-5 h-5 sm:w-6 sm:h-6" />
                    </button>
                </div>
            </div>
            <div class="p-4 sm:p-6">
                <!-- Campos de búsqueda para inventario -->
                <div class="mb-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-3 sm:gap-4">
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-300 mb-1 sm:mb-2">
                                Buscar por NI
                            </label>
                            <input wire:model.live="inventorySearchNi" type="text" placeholder="NI..."
                                class="w-full px-2 sm:px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-300 mb-1 sm:mb-2">
                                Buscar por SN
                            </label>
                            <input wire:model.live="inventorySearchSn" type="text" placeholder="SN..."
                                class="w-full px-2 sm:px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-300 mb-1 sm:mb-2">
                                Buscar por TYPE
                            </label>
                            <input wire:model.live="inventorySearchType" type="text" placeholder="TYPE..."
                                class="w-full px-2 sm:px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-300 mb-1 sm:mb-2">
                                Buscar por ARTICULO
                            </label>
                            <input wire:model.live="inventorySearchArticulo" type="text" placeholder="ARTICULO..."
                                class="w-full px-2 sm:px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-300 mb-1 sm:mb-2">
                                Buscar por Nombre Usuario
                            </label>
                            <input wire:model.live="inventorySearchUserName" type="text" placeholder="Nombre usuario..."
                                class="w-full px-2 sm:px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-300 mb-1 sm:mb-2">
                                Buscar por Dirección Usuario
                            </label>
                            <input wire:model.live="inventorySearchUserDirection" type="text" placeholder="Dirección usuario..."
                                class="w-full px-2 sm:px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        </div>
                    </div>
                </div>
                
                <!-- Tabla de inventarios -->
                <div class="bg-gray-700 rounded-3xl overflow-hidden border border-gray-600">
                    <div class="overflow-x-auto">
                        <table class="w-full rounded-3xl overflow-hidden">
                            <thead class="bg-gray-600">
                                <tr>
                                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        NI / SN
                                    </th>
                                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider hidden sm:table-cell">
                                        TYPE
                                    </th>
                                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider hidden lg:table-cell">
                                        ARTICULO
                                    </th>
                                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider hidden xl:table-cell">
                                        USUARIO / DIRECCIÓN
                                    </th>
                                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-700 divide-y divide-gray-600">
                                @forelse($filteredInventories as $inv)
                                    <tr wire:key="inv-{{ $inv->id }}" class="hover:bg-gray-600 transition-colors">
                                        <td class="px-2 sm:px-4 py-3 sm:py-4 whitespace-nowrap text-xs text-gray-300">
                                            <div class="flex flex-col space-y-1">
                                                <div><span class="text-blue-400 font-medium">NI:</span> {{ $inv->ni ?? 'N/A' }}</div>
                                                <div><span class="text-green-400 font-medium">SN:</span> {{ $inv->ns ?? 'N/A' }}</div>
                                            </div>
                                            <!-- Información adicional visible en móvil -->
                                            <div class="sm:hidden text-xs text-gray-400 mt-2">
                                                <div><strong>TYPE:</strong> {{ $inv->type ?? 'N/A' }}</div>
                                                <div><strong>ARTICULO:</strong> {{ $inv->articulo ?? 'N/A' }}</div>
                                            </div>
                                        </td>
                                        <td class="px-2 sm:px-4 py-3 sm:py-4 whitespace-nowrap text-xs text-gray-300 hidden sm:table-cell">
                                            {{ $inv->type ?? 'N/A' }}
                                        </td>
                                        <td class="px-2 sm:px-4 py-3 sm:py-4 whitespace-nowrap text-xs text-gray-300 hidden lg:table-cell">
                                            {{ $inv->articulo ?? 'N/A' }}
                                        </td>
                                        <td class="px-2 sm:px-4 py-3 sm:py-4 whitespace-nowrap text-xs text-gray-300 hidden xl:table-cell">
                                            @if ($inv->assignedUser)
                                                <div class="flex flex-col space-y-1">
                                                    <div><span class="text-blue-400 font-medium">Usuario:</span> {{ $inv->assignedUser->name }}</div>
                                                    <div><span class="text-[10px] text-gray-400">{{ $inv->assignedUser->position ?? 'N/A' }}</span></div>
                                                    <div><span class="text-green-400 font-medium">Dirección:</span> {{ $inv->assignedUser->direction ?? 'N/A' }}</div>
                                                </div>
                                            @elseif($inv->responsible)
                                                <div class="flex flex-col space-y-1">
                                                    <div><span class="text-blue-400 font-medium">Usuario:</span> {{ $inv->responsible->name }}</div>
                                                    <div><span class="text-[10px] text-gray-400">{{ $inv->responsible->position ?? 'N/A' }}</span></div>
                                                    <div><span class="text-green-400 font-medium">Dirección:</span> {{ $inv->responsible->direction ?? 'N/A' }}</div>
                                                </div>
                                            @else
                                                <div class="flex flex-col space-y-1">
                                                    <div><span class="text-blue-400 font-medium">Usuario:</span> <span class="text-gray-500">Sin usuario</span></div>
                                                    <div><span class="text-green-400 font-medium">Dirección:</span> <span class="text-gray-500">N/A</span></div>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-2 sm:px-4 py-3 sm:py-4 whitespace-nowrap text-xs font-medium">
                                            <button wire:click="selectInventory({{ $inv->id }})"
                                                class="text-green-400 hover:text-green-300 transition-colors"
                                                title="Seleccionar">
                                                <i class="ri-invision-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 sm:px-6 py-8 sm:py-12 text-center text-gray-400">
                                            <x-lucide name="package-x" class="w-8 h-8 sm:w-12 sm:h-12 mx-auto mb-3 sm:mb-4 text-gray-600" />
                                            <p class="text-sm sm:text-lg">No se encontraron inventarios</p>
                                            <p class="text-xs sm:text-sm">Intenta con otros términos de búsqueda</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Botones del modal -->
                <div class="flex justify-end gap-2 sm:gap-3 pt-4 border-t border-gray-700 mt-4">
                    <button type="button" wire:click="closeInventoryModal"
                        class="px-3 sm:px-4 py-2 text-gray-300 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif 