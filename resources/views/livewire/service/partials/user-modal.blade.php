<!-- Modal de Selección de Usuario -->
@if ($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-2 sm:p-4">
        <div class="bg-gray-800 rounded-lg shadow-xl w-full max-w-full max-h-[90vh] overflow-y-auto">
            <div class="p-4 sm:p-6 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-base sm:text-lg font-medium text-white">
                        Selección de Usuario
                        <div class="text-xs text-gray-400 font-normal mt-1">
                            {{ $modalType ?? '' }},
                            {{ $modalParam1 ?? '' }},
                            {{ $modalParam2 ?? '' }},
                            {{ $modalParam4 ?? '' }},
                        </div>
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-white transition-colors">
                        <x-lucide name="x" class="w-5 h-5 sm:w-6 sm:h-6" />
                    </button>
                </div>
            </div>
            <div class="p-4 sm:p-6">
                <!-- Campos de búsqueda -->
                <div class="mb-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-300 mb-1 sm:mb-2">
                                Buscar por Nombre
                            </label>
                            <input wire:model.live="userSearchName" type="text" placeholder="Nombre..."
                                class="w-full px-2 sm:px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-300 mb-1 sm:mb-2">
                                Buscar por Posición
                            </label>
                            <input wire:model.live="userSearchPosition" type="text" placeholder="Posición..."
                                class="w-full px-2 sm:px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-300 mb-1 sm:mb-2">
                                Buscar por Dirección
                            </label>
                            <input wire:model.live="userSearchDirection" type="text" placeholder="Dirección..."
                                class="w-full px-2 sm:px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-300 mb-1 sm:mb-2">
                                Buscar por Nivel
                            </label>
                            <input wire:model.live="userSearchLvl" type="text" placeholder="Nivel..."
                                class="w-full px-2 sm:px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        </div>
                    </div>
                </div>
                
                <!-- Tabla de usuarios -->
                <div class="bg-gray-700 rounded-3xl overflow-hidden border border-gray-600">
                    <div class="overflow-x-auto">
                        <table class="w-full rounded-3xl overflow-hidden">
                            <thead class="bg-gray-600">
                                <tr>
                                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider hidden sm:table-cell">
                                        RFC
                                    </th>
                                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider hidden lg:table-cell">
                                        Posición
                                    </th>
                                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider hidden lg:table-cell">
                                        Dirección
                                    </th>
                                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider hidden xl:table-cell">
                                        Sexo
                                    </th>
                                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider hidden xl:table-cell">
                                        Tipo
                                    </th>
                                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider hidden xl:table-cell">
                                        Nivel
                                    </th>
                                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-700 divide-y divide-gray-600">
                                @forelse($filteredUsers as $user)
                                    <tr wire:key="user-{{ $user->id }}" class="hover:bg-gray-600 transition-colors">
                                        <td class="px-2 sm:px-4 py-3 sm:py-4 whitespace-nowrap text-xs text-gray-300">
                                            <div class="font-medium text-white text-xs">{{ $user->name }}</div>
                                            <!-- Información adicional visible en móvil -->
                                            <div class="sm:hidden text-xs text-gray-400 mt-1">
                                                {{ $user->position ?? 'N/A' }} - {{ $user->direction ?? 'N/A' }}
                                            </div>
                                        </td>
                                        <td class="px-2 sm:px-4 py-3 sm:py-4 whitespace-nowrap text-xs text-gray-300 hidden sm:table-cell">
                                            {{ $user->rfc ?? 'N/A' }}
                                        </td>
                                        <td class="px-2 sm:px-4 py-3 sm:py-4 whitespace-nowrap text-xs text-gray-300 hidden lg:table-cell">
                                            {{ $user->position ?? 'N/A' }}
                                        </td>
                                        <td class="px-2 sm:px-4 py-3 sm:py-4 whitespace-nowrap text-xs text-gray-300 hidden lg:table-cell">
                                            {{ $user->direction ?? 'N/A' }}
                                        </td>
                                        <td class="px-2 sm:px-4 py-3 sm:py-4 whitespace-nowrap text-xs text-gray-300 hidden xl:table-cell">
                                            {{ $user->sex ?? 'N/A' }}
                                        </td>
                                        <td class="px-2 sm:px-4 py-3 sm:py-4 whitespace-nowrap text-xs text-gray-300 hidden xl:table-cell">
                                            {{ $user->tipo ?? 'N/A' }}
                                        </td>
                                        <td class="px-2 sm:px-4 py-3 sm:py-4 whitespace-nowrap text-xs text-gray-300 hidden xl:table-cell">
                                            {{ $user->lvl ?? 'N/A' }}
                                        </td>
                                        <td class="px-2 sm:px-4 py-3 sm:py-4 whitespace-nowrap text-xs font-medium">
                                            <button wire:click="selectUser({{ $user->id }}, @js($user->name))"
                                                class="text-blue-400 hover:text-blue-300 transition-colors"
                                                title="Seleccionar">
                                                <i class="ri-shield-user-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-4 sm:px-6 py-8 sm:py-12 text-center text-gray-400">
                                            <x-lucide name="user-x" class="w-8 h-8 sm:w-12 sm:h-12 mx-auto mb-3 sm:mb-4 text-gray-600" />
                                            <p class="text-sm sm:text-lg">No se encontraron usuarios</p>
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
                    <button type="button" wire:click="closeModal"
                        class="px-3 sm:px-4 py-2 text-gray-300 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif 