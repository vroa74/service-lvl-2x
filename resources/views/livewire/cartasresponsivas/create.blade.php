<div class="min-h-screen bg-gray-900 p-6">
    <div class="flex gap-6 h-full">
        <!-- Primera columna - Formulario actual (34%) -->
        <div class="w-[34%]">
            <div class="max-w-full p-6 bg-gray-800 rounded-lg shadow">
                @if (session()->has('message'))
                    <div class="mb-4 p-3 bg-green-600 text-white rounded">{{ session('message') }}</div>
                @endif
                <form wire:submit.prevent="save" class="space-y-4">
                    <div>
                        <label class="block text-gray-200 mb-1">Usuario que genera</label>
                        <select wire:model="user_id" class="w-full rounded p-2 bg-gray-900 text-gray-100">
                            <option value="">Seleccione...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-200 mb-1">Responsable</label>
                        <select wire:model="responsable_id" class="w-full rounded p-2 bg-gray-900 text-gray-100">
                            <option value="">Seleccione...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('responsable_id') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-200 mb-1">Informática</label>
                        <select wire:model="informatica_id" class="w-full rounded p-2 bg-gray-900 text-gray-100">
                            <option value="">Seleccione...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('informatica_id') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-200 mb-1">Fecha</label>
                        <input type="date" wire:model="fecha" class="w-full rounded p-2 bg-gray-900 text-gray-100">
                        @error('fecha') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-200 mb-1">Código</label>
                        <input type="text" wire:model="codigo" class="w-full rounded p-2 bg-gray-900 text-gray-100">
                        @error('codigo') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" wire:model="auditoria" id="auditoria" class="rounded">
                        <label for="auditoria" class="text-gray-200">Auditoría</label>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Segunda columna - Tabla de Inventarios (33%) -->
        <div class="w-[33%]">
            <div class="p-6 bg-gray-800 rounded-lg shadow h-full overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-gray-200 text-lg font-medium">Inv. de la Carta Responsiva</h3>
                    <button 
                        wire:click="openInventoryModal"
                        class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-sm rounded transition-colors"
                    >
                        + Agregar Item
                    </button>
                </div>
                
                @error('selected_inventories') 
                    <div class="mb-3 p-2 bg-red-900 text-red-200 text-xs rounded">{{ $message }}</div> 
                @enderror

                <!-- Tabla de inventarios seleccionados -->
                <div class="bg-gray-700 rounded-lg overflow-hidden">
                    @if(count($selected_inventories) > 0)
                        <table class="w-full">
                            <thead class="bg-gray-600">
                                <tr>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-300">Artículo</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-300">NI</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-300">SN</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-300">Descripción</th>
                                    <th class="px-3 py-2 text-center text-xs font-medium text-gray-300 w-16">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-600">
                                @foreach($this->getSelectedInventoryItems() as $inventory)
                                    <tr class="hover:bg-gray-600 transition-colors">
                                        <td class="px-3 py-2 text-sm text-gray-200">
                                            <div class="font-medium">{{ $inventory->articulo ?? 'N/A' }}</div>
                                            <div class="text-xs text-gray-400">{{ $inventory->marca ?? 'N/A' }} {{ $inventory->modelo ?? 'N/A' }}</div>
                                        </td>
                                        <td class="px-3 py-2 text-sm text-gray-200">{{ $inventory->ni ?? 'N/A' }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-200">{{ $inventory->ns ?? 'N/A' }}</td>
                                        <td class="px-3 py-2">
                                            <textarea 
                                                wire:model="inventoryDescriptions.{{ $inventory->id }}"
                                                placeholder="Descripción..."
                                                class="w-full px-2 py-1 bg-gray-600 border border-gray-500 rounded text-white text-xs placeholder-gray-400 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 resize-none"
                                                rows="2"
                                            ></textarea>
                                        </td>
                                        <td class="px-3 py-2 text-center flex flex-col gap-2 items-center">
                                            <div class="flex gap-1">
                                                <button 
                                                    class="px-2 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs rounded transition-colors flex items-center gap-1"
                                                    title="Agregar foto"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M4 12l1.41-1.41a2 2 0 012.83 0L12 15l3.76-3.76a2 2 0 012.83 0L20 12M12 15V3" /></svg>
                                                </button>
                                                <button 
                                                    class="px-2 py-1 bg-purple-600 hover:bg-purple-700 text-white text-xs rounded transition-colors flex items-center gap-1"
                                                    title="Ver fotos"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553 2.276A2 2 0 0121 14.118V17a2 2 0 01-2 2H5a2 2 0 01-2-2v-2.882a2 2 0 01.447-1.842L8 10m7 0V7a2 2 0 00-2-2h-2a2 2 0 00-2 2v3m7 0H8" /></svg>
                                                </button>
                                            </div>
                                            <button 
                                                wire:click="removeInventory({{ $inventory->id }})"
                                                class="px-2 py-1 bg-red-600 hover:bg-red-700 text-white text-xs rounded transition-colors mt-1"
                                                title="Eliminar item"
                                            >
                                                ×
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="p-8 text-center text-gray-400">
                            <div class="text-4xl mb-2">📋</div>
                            <p class="text-sm">No hay inventarios seleccionados</p>
                            <p class="text-xs mt-1">Haz clic en "Agregar Item" para comenzar</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal para seleccionar inventarios -->
        @if($showInventoryModal)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-1">
                <div class="bg-gray-800 rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] flex flex-col">
                    <div class="p-6 border-b border-gray-700 flex-shrink-0">
                        <div class="flex justify-between items-center">
                            <h3 class="text-gray-200 text-lg font-medium">Seleccionar Inventario</h3>
                            <button 
                                wire:click="closeInventoryModal"
                                class="text-gray-400 hover:text-white transition-colors"
                            >
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="p-6 flex-1 flex flex-col min-h-0">
                        <!-- Búsqueda -->
                        <div class="mb-4 flex-shrink-0">
                            <label class="block text-gray-200 text-sm mb-2">Buscar inventarios</label>
                            <input 
                                type="text" 
                                wire:model.live="inventorySearch" 
                                placeholder="Buscar por artículo, NI, SN, marca, modelo..."
                                class="w-full rounded p-3 bg-gray-700 text-gray-100 border border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            >
                        </div>

                        <!-- Tabla de inventarios disponibles con scroll -->
                        <div class="bg-gray-700 rounded-lg flex-1 flex flex-col min-h-0">
                            <div class="overflow-y-auto flex-1 min-h-0" style="max-height: 50vh;">
                                <table class="w-full">
                                    <thead class="bg-gray-600 sticky top-0">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300">Artículo</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300">NI</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300">SN</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300">Marca/Modelo</th>
                                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-300 w-20">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-600">
                                        @forelse($this->getFilteredInventoriesPaginated() as $inventory)
                                            <tr class="hover:bg-gray-600 transition-colors">
                                                <td class="px-4 py-3 text-sm text-gray-200">
                                                    <div class="font-medium">{{ $inventory->articulo ?? 'N/A' }}</div>
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-200">{{ $inventory->ni ?? 'N/A' }}</td>
                                                <td class="px-4 py-3 text-sm text-gray-200">{{ $inventory->ns ?? 'N/A' }}</td>
                                                <td class="px-4 py-3 text-sm text-gray-200">
                                                    {{ $inventory->marca ?? 'N/A' }} {{ $inventory->modelo ?? 'N/A' }}
                                                </td>
                                                <td class="px-4 py-3 text-center">
                                                    <button 
                                                        wire:click="selectInventory({{ $inventory->id }})"
                                                        class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs rounded transition-colors"
                                                        title="Seleccionar"
                                                    >
                                                        Seleccionar
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                                                    <div class="text-3xl mb-2">🔍</div>
                                                    <p>No se encontraron inventarios</p>
                                                    <p class="text-sm mt-1">Intenta con otros términos de búsqueda</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Paginación -->
                            @if($this->getFilteredInventoriesPaginated()->hasPages())
                                <div class="border-t border-gray-600 p-4 bg-gray-600 flex-shrink-0">
                                    {{ $this->getFilteredInventoriesPaginated()->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Tercera columna - Acordeón de fotos (33%) -->
        <div class="w-[33%]">
            <div class="p-6 bg-gray-800 rounded-lg shadow h-full overflow-y-auto">
                <h3 class="text-gray-200 text-lg font-medium mb-4">Fotos de Inventarios</h3>
                <div class="space-y-4">
                    @foreach($openPhotoAccordion as $invId => $open)
                        @php
                            $inv = $this->getSelectedInventoryItems()->firstWhere('id', $invId);
                        @endphp
                        @if($open && $inv)
                        <div class="border border-gray-700 rounded-lg bg-gray-700">
                            <button type="button" class="w-full flex justify-between items-center px-4 py-3 bg-gray-700 rounded-t-lg focus:outline-none" @click="openPhotoAccordion[{{ $invId }}] = !openPhotoAccordion[{{ $invId }}]">
                                <span class="font-semibold text-gray-100 text-sm">{{ $inv->articulo }} (NI: {{ $inv->ni }})</span>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <div class="px-4 py-3 space-y-3">
                                <!-- Formulario de subida de foto -->
                                <form wire:submit.prevent="addPhoto({{ $invId }})" class="space-y-2">
                                    <div>
                                        <label class="block text-xs text-gray-300 mb-1">Seleccionar imagen</label>
                                        <input type="file" wire:model="photo.{{ $invId }}" accept="image/*" class="block w-full text-xs text-gray-200 bg-gray-800 border border-gray-600 rounded" />
                                        @error('photo.' . $invId) <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    @if(isset($photoPreview[$invId]) && $photoPreview[$invId])
                                        <div class="mb-2">
                                            <img src="{{ $photoPreview[$invId] }}" alt="Vista previa" class="h-24 rounded border border-gray-500 mx-auto" />
                                        </div>
                                    @endif
                                    <div>
                                        <label class="block text-xs text-gray-300 mb-1">Descripción (opcional)</label>
                                        <input type="text" wire:model="photoDescription.{{ $invId }}" class="w-full px-2 py-1 bg-gray-800 border border-gray-600 rounded text-white text-xs placeholder-gray-400" placeholder="Descripción de la foto..." />
                                        @error('photoDescription.' . $invId) <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded text-xs">Agregar Foto</button>
                                    </div>
                                </form>
                                <!-- Aquí podrías mostrar la lista de fotos ya subidas para este inventario -->
                                <div class="mt-2">
                                    <h4 class="text-xs text-gray-300 mb-1 font-semibold">Fotos subidas</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($this->getPhotosForSelectedInventory() as $photo)
                                            @if($photo->inventory_id == $invId)
                                                <div class="relative">
                                                    <img src="{{ asset('storage/' . $photo->path) }}" alt="Foto" class="h-16 w-16 object-cover rounded border border-gray-500" />
                                                    <button wire:click="deletePhoto({{ $photo->id }})" class="absolute top-0 right-0 bg-red-700 text-white rounded-full px-1 text-xs" title="Eliminar foto">×</button>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
