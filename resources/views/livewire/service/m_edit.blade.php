<div class="min-h-screen bg-gray-900 p-2 sm:p-4">
    <!-- Layout responsive: Stack vertical en móvil, horizontal en desktop -->
    <div class="flex flex-col lg:flex-row gap-4 h-full">
        
        <!-- Primera columna - Formulario principal (100% en móvil, 67% en desktop) -->
        <div class="w-full lg:w-[67%] order-2 lg:order-1">
            <div class="bg-gray-800 rounded-lg mb-4 lg:mb-1 shadow-xl w-full max-w-full px-4 sm:px-6 lg:px-8 mx-auto">
                
                <!-- Mensajes de error y éxito -->
                @if (session()->has('error'))
                    <div class="p-3 sm:p-4 mb-4 bg-red-600 border border-red-500 rounded-lg">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <x-lucide name="alert-triangle" class="w-4 h-4 sm:w-5 sm:h-5 text-red-200" />
                                    <p class="text-white font-medium text-sm sm:text-base">Error:</p>
                                </div>
                                <div class="text-red-100 text-xs sm:text-sm whitespace-pre-line">{{ session('error') }}</div>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="text-red-200 hover:text-white ml-2 sm:ml-4">
                                <x-lucide name="x" class="w-4 h-4 sm:w-5 sm:h-5" />
                            </button>
                        </div>
                    </div>
                @endif

                @if (session()->has('message'))
                    <div class="p-3 sm:p-4 mb-4 bg-green-600 border border-green-500 rounded-lg">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <x-lucide name="check-circle" class="w-4 h-4 sm:w-5 sm:h-5 text-green-200" />
                                    <p class="text-white font-medium text-sm sm:text-base">Éxito:</p>
                                </div>
                                <div class="text-green-100 text-xs sm:text-sm">{{ session('message') }}</div>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="text-green-200 hover:text-white ml-2 sm:ml-4">
                                <x-lucide name="x" class="w-4 h-4 sm:w-5 sm:h-5" />
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Advertencias de configuración del servidor -->
                @if (!empty($serverWarnings))
                    <div class="p-3 sm:p-4 mb-4 bg-yellow-600 border border-yellow-500 rounded-lg">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <x-lucide name="alert-triangle" class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-200" />
                                    <p class="text-white font-medium text-sm sm:text-base">Advertencias de configuración:</p>
                                </div>
                                <ul class="text-yellow-100 text-xs sm:text-sm list-disc list-inside space-y-1">
                                    @foreach ($serverWarnings as $warning)
                                        <li>{{ $warning }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="text-yellow-200 hover:text-white ml-2 sm:ml-4">
                                <x-lucide name="x" class="w-4 h-4 sm:w-5 sm:h-5" />
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Header del formulario -->
                <div class="p-3 sm:p-4 border-b border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-base sm:text-lg font-medium text-white">
                            Editar Servicio
                        </h3>
                        <a href="{{ route('servicios.index') }}" class="text-gray-400 hover:text-white transition-colors">
                            <x-lucide name="x" class="w-5 h-5 sm:w-6 sm:h-6" />
                        </a>
                    </div>
                </div>

                <!-- Formulario -->
                <form wire:submit.prevent="updateService" class="p-4 sm:p-6 space-y-4 sm:space-y-6">
                    
                    <!-- Información básica - Grid responsive -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                        <div>
                            <label for="id_s" class="block text-xs sm:text-sm font-medium text-gray-300 mb-1 sm:mb-2">
                                ID Servicio
                            </label>
                            <input wire:model="id_s" type="text" id="id_s"
                                class="w-full px-2 sm:px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                placeholder="ID del servicio">
                            @error('id_s')
                                <span class="text-red-400 text-xs sm:text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="F_serv" class="block text-xs sm:text-sm font-medium text-gray-300 mb-1 sm:mb-2">
                                Fecha de Servicio
                            </label>
                            <input wire:model="F_serv" type="date" id="F_serv"
                                class="w-full px-2 sm:px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                            @error('F_serv')
                                <span class="text-red-400 text-xs sm:text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Descripción del servicio -->
                    <div>
                        <div class="flex flex-wrap items-center gap-1 sm:gap-2 mb-2">
                            <label for="obj_sol" class="block text-xs sm:text-sm font-medium text-gray-300">
                                Objetivo de la Solicitud
                            </label>
                            <button type="button" wire:click="openUserModal('objetivo', 'null', 'null', null, 'null')"
                                class="px-2 sm:px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm rounded-lg transition-colors flex items-center gap-1">
                                <x-lucide name="users" class="w-3 h-3 sm:w-4 sm:h-4" />
                            </button>
                            <button type="button" wire:click="openInventoryModal('objetivo')"
                                class="px-2 sm:px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs sm:text-sm rounded-lg transition-colors flex items-center gap-1">
                                <x-lucide name="list-search" class="w-3 h-3 sm:w-4 sm:h-4" />
                            </button>
                        </div>
                        <textarea wire:model.defer="obj_sol" wire:blur="$refresh" id="obj_sol" rows="6"
                            class="w-full px-2 sm:px-3 py-2 text-xs bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Describa el objetivo de la solicitud"></textarea>
                        @error('obj_sol')
                            <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Actividades y Observaciones - Stack en móvil, grid en desktop -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div>
                            <div class="flex flex-wrap items-center gap-1 sm:gap-2 mb-2">
                                <label for="actividades" class="block text-xs sm:text-sm font-medium text-gray-300">
                                    Actividades Realizadas
                                </label>
                                <button type="button" wire:click="openUserModal('actividades', 'null', 'null', null, 'null')"
                                    class="px-2 sm:px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm rounded-lg transition-colors flex items-center gap-1">
                                    <x-lucide name="users" class="w-3 h-3 sm:w-4 sm:h-4" />
                                </button>
                                <button type="button" wire:click="openInventoryModal('actividades')"
                                    class="px-2 sm:px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs sm:text-sm rounded-lg transition-colors flex items-center gap-1">
                                    <x-lucide name="list-search" class="w-3 h-3 sm:w-4 sm:h-4" />
                                </button>
                            </div>
                            <textarea wire:model.defer="actividades" wire:blur="$refresh" id="actividades" rows="6"
                                class="w-full px-2 sm:px-3 py-2 text-xs bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Describa las actividades realizadas"></textarea>
                            @error('actividades')
                                <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <div class="flex flex-wrap items-center gap-1 sm:gap-2 mb-2">
                                <label for="observaciones" class="block text-xs sm:text-sm font-medium text-gray-300">
                                    Observaciones
                                </label>
                                <button type="button" wire:click="openUserModal('observaciones', 'null', 'null', null, 'null')"
                                    class="px-2 sm:px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm rounded-lg transition-colors flex items-center gap-1">
                                    <x-lucide name="users" class="w-3 h-3 sm:w-4 sm:h-4" />
                                </button>
                                <button type="button" wire:click="openInventoryModal('observaciones')"
                                    class="px-2 sm:px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs sm:text-sm rounded-lg transition-colors flex items-center gap-1">
                                    <x-lucide name="list-search" class="w-3 h-3 sm:w-4 sm:h-4" />
                                </button>
                            </div>
                            <textarea wire:model.defer="observaciones" wire:blur="$refresh" id="observaciones" rows="6"
                                class="w-full px-2 sm:px-3 py-2 text-xs bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Observaciones adicionales"></textarea>
                            @error('observaciones')
                                <span class="text-red-400 text-xs sm:text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Tipo de Servicio y Via de Solicitud -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                        <!-- Tipo de servicio -->
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-300 mb-2 sm:mb-3">
                                Tipo de Servicio
                            </label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 sm:gap-3">
                                <label class="flex items-center">
                                    <input wire:model="correctivo" type="checkbox"
                                        class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                                    <span class="ml-2 text-xs sm:text-sm text-gray-300">Correctivo</span>
                                </label>
                                <label class="flex items-center">
                                    <input wire:model="preventivo" type="checkbox"
                                        class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                                    <span class="ml-2 text-xs sm:text-sm text-gray-300">Preventivo</span>
                                </label>
                                <label class="flex items-center">
                                    <input wire:model="transparencia" type="checkbox"
                                        class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                                    <span class="ml-2 text-xs sm:text-sm text-gray-300">Transparencia</span>
                                </label>
                                <label class="flex items-center">
                                    <input wire:model="a_tec" type="checkbox"
                                        class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                                    <span class="ml-2 text-xs sm:text-sm text-gray-300">A. Técnico</span>
                                </label>
                                <label class="flex items-center">
                                    <input wire:model="web_ins" type="checkbox"
                                        class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                                    <span class="ml-2 text-xs sm:text-sm text-gray-300">Web/Ins</span>
                                </label>
                                <label class="flex items-center">
                                    <input wire:model="print" type="checkbox"
                                        class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                                    <span class="ml-2 text-xs sm:text-sm text-gray-300">Print</span>
                                </label>
                            </div>
                            @error('tipo_servicio')
                                <span class="text-red-400 text-xs sm:text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Via de solicitud -->
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-300 mb-2 sm:mb-3">
                                Via de Solicitud
                            </label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 sm:gap-3">
                                <label class="flex items-center">
                                    <input wire:model="email" type="checkbox"
                                        class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                                    <span class="ml-2 text-xs sm:text-sm text-gray-300">Email</span>
                                </label>
                                <label class="flex items-center">
                                    <input wire:model="tel" type="checkbox"
                                        class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                                    <span class="ml-2 text-xs sm:text-sm text-gray-300">Teléfono</span>
                                </label>
                                <label class="flex items-center">
                                    <input wire:model="sol_ser" type="checkbox"
                                        class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                                    <span class="ml-2 text-xs sm:text-sm text-gray-300">Solicitud</span>
                                </label>
                                <label class="flex items-center">
                                    <input wire:model="oficio" type="checkbox"
                                        class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                                    <span class="ml-2 text-xs sm:text-sm text-gray-300">Oficio</span>
                                </label>
                                <label class="flex items-center">
                                    <input wire:model.live="calendario" type="checkbox"
                                        class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                                    <span class="ml-2 text-xs sm:text-sm text-gray-300">Calendario</span>
                                </label>
                            </div>
                            @error('via_solicitud')
                                <span class="text-red-400 text-xs sm:text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Mantenimiento -->
                    @if ($calendario)
                        <div>
                            <div class="flex flex-wrap items-center gap-1 sm:gap-2 mb-2">
                                <label for="mantenimiento" class="block text-xs sm:text-sm font-medium text-gray-300">
                                    Mantenimiento
                                </label>
                                <button type="button" wire:click="openUserModal('mantenimiento', 'null', 'null', null, 'null')"
                                    class="px-2 sm:px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm rounded-lg transition-colors flex items-center gap-1">
                                    <x-lucide name="users" class="w-3 h-3 sm:w-4 sm:h-4" />
                                </button>
                                <button type="button" wire:click="openInventoryModal('mantenimiento')"
                                    class="px-2 sm:px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs sm:text-sm rounded-lg transition-colors flex items-center gap-1">
                                    <x-lucide name="list-search" class="w-3 h-3 sm:w-4 sm:h-4" />
                                </button>
                            </div>
                            <textarea wire:model.defer="mantenimiento" wire:blur="$refresh" id="mantenimiento" rows="6"
                                class="w-full px-2 sm:px-3 py-2 text-xs bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Detalles de mantenimiento"></textarea>
                            @error('mantenimiento')
                                <span class="text-red-400 text-xs sm:text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <!-- Usuarios involucrados - Stack en móvil -->
                    <div>
                        <label class="block text-xs sm:text-sm font-medium text-gray-300 mb-2 sm:mb-3">
                            Usuarios Involucrados
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 sm:gap-4">
                            <!-- Solicitante -->
                            <div class="bg-gray-700 rounded-lg p-3 sm:p-4 text-center">
                                <div class="font-semibold text-gray-200 mb-2 flex flex-col items-center justify-center">
                                    <div class="flex items-center gap-1 sm:gap-2">
                                        <label class="block text-xs sm:text-sm font-medium text-gray-300">
                                            Solicitante
                                        </label>
                                        <button type="button" wire:click="openUserModal('Solicitante', 'null', 'null', null, 'null')"
                                            class="px-2 sm:px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm rounded-lg transition-colors flex items-center gap-1">
                                            <x-lucide name="users" class="w-3 h-3 sm:w-4 sm:h-4" />
                                        </button>
                                    </div>
                                </div>
                                <div class="text-gray-400 text-xs sm:text-sm">
                                    {{ $solicitante_name }}
                                    {{ $solicitante_position }}
                                    {{ $solicitante_direction }}
                                    @error('solicitante_id')
                                        <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Efectuó -->
                            <div class="bg-gray-700 rounded-lg p-3 sm:p-4 text-center">
                                <div class="font-semibold text-gray-200 mb-2 flex flex-col items-center justify-center">
                                    <div class="flex items-center gap-1 sm:gap-2">
                                        <label class="block text-xs sm:text-sm font-medium text-gray-300">
                                            Efectuó
                                        </label>
                                        <button type="button" wire:click="openUserModal('efectuo', 'null', 'infor', null, 'null')"
                                            class="px-2 sm:px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm rounded-lg transition-colors flex items-center gap-1">
                                            <x-lucide name="users" class="w-3 h-3 sm:w-4 sm:h-4" />
                                        </button>
                                    </div>
                                </div>
                                <div class="text-gray-400 text-xs sm:text-sm">
                                    {{ $efectuo_name }}
                                    {{ $efectuo_position }}
                                    {{ $efectuo_direction }}
                                    @error('efectuo_id')
                                        <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- VºBº -->
                            <div class="bg-gray-700 rounded-lg p-3 sm:p-4 text-center">
                                <div class="font-semibold text-gray-200 mb-2 flex flex-col items-center justify-center">
                                    <div class="flex items-center gap-1 sm:gap-2">
                                        <label class="block text-xs sm:text-sm font-medium text-gray-300">
                                            VºBº
                                        </label>
                                        <button type="button" wire:click="openUserModal('vobo', 'null', 'infor', 4, 'null')"
                                            class="px-2 sm:px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm rounded-lg transition-colors flex items-center gap-1">
                                            <x-lucide name="users" class="w-3 h-3 sm:w-4 sm:h-4" />
                                        </button>
                                    </div>
                                </div>
                                <div class="text-gray-400 text-xs sm:text-sm">
                                    {{ $vobo_name }}
                                    {{ $vobo_position }}
                                    {{ $vobo_direction }}
                                    @error('vobo_id')
                                        <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex flex-col sm:flex-row justify-end gap-2 sm:gap-3 pt-4 border-t border-gray-700">
                        <a href="{{ route('servicios.index') }}"
                            class="px-4 py-2 text-gray-300 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors text-center text-sm">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex items-center justify-center gap-2 text-sm">
                            <x-lucide name="save" class="w-4 h-4" />
                            Actualizar Servicio
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Segunda columna - Fotos del Servicio (100% en móvil, 33% en desktop) -->
        <div class="w-full lg:w-[33%] order-1 lg:order-2">
            <div class="p-4 sm:p-6 bg-gray-800 rounded-lg shadow h-full overflow-y-auto border border-gray-700">
                <h3 class="text-gray-100 text-base sm:text-lg font-medium mb-4">Fotos de Servicios</h3>

                <!-- Header azul con identificador -->
                <div class="rounded-t-xl bg-blue-600 text-white text-sm sm:text-base font-semibold px-3 sm:px-4 py-2 mb-3 border border-blue-600">
                    {{ $id_s }}
                </div>

                <!-- Botón para agregar foto -->
                <div class="mb-3">
                    <button type="button" wire:click="openPhotoForm"
                        class="add-photo-btn w-full text-white px-3 sm:px-4 py-2 sm:py-3 rounded-lg text-xs sm:text-sm flex items-center justify-center gap-2 transition-all duration-200 hover:scale-105 font-medium">
                        <x-lucide name="plus" class="w-3 h-3 sm:w-4 sm:h-4" />
                        Agregar foto
                    </button>
                </div>

                <!-- Contenedor de fotos -->
                <div class="border border-gray-500 rounded-xl bg-gray-900 px-2 py-3 mb-4">
                    @if (count($servicePhotos) > 0)
                        <div class="photos-grid mb-3">
                            @foreach ($servicePhotos as $index => $photo)
                                <div class="photo-card flex flex-col items-center bg-gray-800 border border-gray-600 rounded-lg p-2 relative hover:border-gray-500 transition-colors"
                                    wire:dblclick="openPhotoForm({{ $index }})">
                                    <!-- Imagen con tamaño adaptable -->
                                    <div class="photo-image-container">
                                        <img src="{{ $photo['preview'] }}" alt="Foto del servicio"
                                            class="photo-image" />
                                    </div>

                                    <!-- Botón eliminar -->
                                    <button wire:click="deletePhoto({{ $index }})"
                                        class="delete-photo-btn absolute top-1 right-1 bg-red-600 hover:bg-red-700 text-white rounded-full w-4 h-4 sm:w-5 sm:h-5 flex items-center justify-center text-xs transition-all duration-200 z-10 shadow-lg"
                                        title="Eliminar foto">
                                        &times;
                                    </button>

                                    <!-- Descripción -->
                                    <div class="w-full text-center px-1">
                                        <div class="text-gray-300 text-xs mb-1 min-h-[14px] flex items-center justify-center">
                                            <span class="{{ empty($photo['description']) ? 'text-gray-400 italic' : '' }} truncate max-w-full">
                                                {{ $photo['description'] ?: 'Agregar descripción' }}
                                            </span>
                                        </div>

                                        <!-- Botón editar -->
                                        <button type="button" wire:click="openPhotoForm({{ $index }})"
                                            class="edit-photo-btn text-blue-400 hover:text-blue-300 transition-colors p-1 rounded"
                                            title="Editar foto">
                                            <x-lucide name="edit" class="w-3 h-3" />
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Mensaje cuando no hay fotos -->
                        <div class="no-photos-message text-center py-6 sm:py-8 text-gray-400">
                            <x-lucide name="image" class="w-8 h-8 sm:w-12 sm:h-12 mx-auto mb-2 sm:mb-3 text-gray-600" />
                            <p class="text-xs sm:text-sm">No hay fotos agregadas</p>
                            <p class="text-xs text-gray-500 mt-1">Usa el botón "Agregar foto" para comenzar</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modales -->
    @include('livewire.service.partials.user-modal')
    @include('livewire.service.partials.inventory-modal')
    @include('livewire.service.partials.photo-modal')

    @livewireStyles
    @livewireScripts

    <style>
        /* Estilos responsive para el grid de fotos */
        .photos-grid {
            display: grid;
            gap: 0.5rem;
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            align-items: start;
            justify-items: center;
        }

        /* Ajustes para diferentes tamaños de pantalla */
        @media (min-width: 480px) {
            .photos-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
                gap: 0.75rem;
            }
        }

        @media (min-width: 640px) {
            .photos-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                gap: 1rem;
            }
        }

        @media (min-width: 768px) {
            .photos-grid {
                grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            }
        }

        @media (min-width: 1024px) {
            .photos-grid {
                grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            }
        }

        /* Mejoras para las tarjetas de fotos */
        .photo-card {
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            width: 100%;
            min-width: 80px;
            max-width: 160px;
            height: auto;
            min-height: 100px;
        }

        .photo-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        /* Contenedor de imagen adaptable */
        .photo-image-container {
            position: relative;
            overflow: hidden;
            border-radius: 0.375rem;
            width: 100%;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #000;
            margin-bottom: 0.5rem;
        }

        @media (min-width: 640px) {
            .photo-image-container {
                height: 70px;
            }
        }

        @media (min-width: 768px) {
            .photo-image-container {
                height: 80px;
            }
        }

        .photo-image {
            transition: transform 0.2s ease-in-out;
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .photo-card:hover .photo-image {
            transform: scale(1.05);
        }

        /* Estilos para el botón agregar foto */
        .add-photo-btn {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            border: 1px solid #047857;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .add-photo-btn:hover {
            background: linear-gradient(135deg, #047857 0%, #065f46 100%);
            border-color: #065f46;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Mejorar el mensaje cuando no hay fotos */
        .no-photos-message {
            background: linear-gradient(135deg, #374151 0%, #4b5563 100%);
            border: 1px solid #6b7280;
            border-radius: 0.5rem;
            margin: 1rem 0;
        }

        /* Mejoras para los botones de acción */
        .delete-photo-btn {
            opacity: 0.8;
            transition: all 0.2s ease-in-out;
        }

        .delete-photo-btn:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        .edit-photo-btn {
            transition: all 0.2s ease-in-out;
        }

        .edit-photo-btn:hover {
            transform: scale(1.1);
            background-color: rgba(59, 130, 246, 0.1);
        }

        /* Mejoras para dispositivos móviles */
        @media (max-width: 640px) {
            .photos-grid {
                grid-template-columns: repeat(auto-fill, minmax(70px, 1fr));
                gap: 0.5rem;
            }

            .photo-card {
                min-width: 70px;
                max-width: 120px;
                min-height: 90px;
            }

            .photo-image-container {
                height: 50px;
            }
        }

        /* Optimizaciones específicas para móviles */
        @media (max-width: 768px) {
            /* Mejorar la legibilidad en pantallas pequeñas */
            .text-xs {
                font-size: 0.75rem;
                line-height: 1rem;
            }
            
            /* Aumentar el tamaño de los botones táctiles */
            button, .btn {
                min-height: 44px;
                min-width: 44px;
            }
            
            /* Mejorar el espaciado en formularios */
            .space-y-4 > * + * {
                margin-top: 1rem;
            }
            
            /* Optimizar el scroll */
            .overflow-y-auto {
                -webkit-overflow-scrolling: touch;
                scroll-behavior: smooth;
            }
            
            /* Mejorar la experiencia táctil */
            .photo-card, button, input, textarea {
                touch-action: manipulation;
            }
            
            /* Reducir animaciones en móviles para mejor rendimiento */
            .transition-all {
                transition: none !important;
            }
            
            /* Optimizar el grid de fotos para móviles */
            .photos-grid {
                grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
                gap: 0.5rem;
            }
            
            /* Mejorar la visibilidad de los modales en móviles */
            .fixed.inset-0 {
                padding: 0.5rem;
            }
            
            /* Optimizar las tablas para móviles */
            table {
                font-size: 0.75rem;
            }
            
            /* Mejorar el contraste en móviles */
            .text-gray-300 {
                color: #d1d5db;
            }
            
            .text-gray-400 {
                color: #9ca3af;
            }
        }

        /* Optimizaciones para tablets */
        @media (min-width: 769px) and (max-width: 1024px) {
            .photos-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
                gap: 0.75rem;
            }
            
            .photo-card {
                min-width: 100px;
                max-width: 140px;
                min-height: 120px;
            }
            
            .photo-image-container {
                height: 70px;
            }
        }

        /* Mejoras de accesibilidad */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Mejoras para pantallas de alta densidad */
        @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
            .photo-image {
                image-rendering: -webkit-optimize-contrast;
                image-rendering: crisp-edges;
            }
        }

        /* Optimizaciones para modo oscuro en móviles */
        @media (prefers-color-scheme: dark) {
            .bg-gray-800 {
                background-color: #1f2937;
            }
            
            .bg-gray-700 {
                background-color: #374151;
            }
            
            .border-gray-600 {
                border-color: #4b5563;
            }
        }

        /* Mejoras para dispositivos con notch */
        @supports (padding: max(0px)) {
            .min-h-screen {
                padding-left: max(0.5rem, env(safe-area-inset-left));
                padding-right: max(0.5rem, env(safe-area-inset-right));
                padding-top: max(0.5rem, env(safe-area-inset-top));
                padding-bottom: max(0.5rem, env(safe-area-inset-bottom));
            }
        }

        /* Optimizaciones para pantallas muy pequeñas */
        @media (max-width: 375px) {
            .photos-grid {
                grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
                gap: 0.25rem;
            }
            
            .photo-card {
                min-width: 60px;
                max-width: 100px;
                min-height: 80px;
            }
            
            .photo-image-container {
                height: 40px;
            }
            
            .text-xs {
                font-size: 0.7rem;
            }
        }

        /* Mejoras para orientación landscape en móviles */
        @media (max-width: 768px) and (orientation: landscape) {
            .min-h-screen {
                min-height: auto;
            }
            
            .photos-grid {
                grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
            }
            
            .photo-card {
                min-width: 90px;
                max-width: 130px;
            }
        }
    </style>

    <script>
        document.addEventListener('livewire:init', () => {
            // Manejo de eventos de actualización de textarea
            Livewire.on('update-textarea', (event) => {
                const field = event.field;
                const value = event.value;
                const textarea = document.getElementById(field);
                if (textarea) {
                    textarea.value = value;
                    textarea.dispatchEvent(new Event('input', { bubbles: true }));
                    console.log(`Textarea ${field} actualizado con valor:`, value);
                } else {
                    console.warn(`Textarea con id '${field}' no encontrado`);
                }
            });

            // Manejo de errores de Livewire
            Livewire.on('error', (error) => {
                console.error('Error de Livewire:', error);
                showNotification('Error: ' + error.message, 'error');
            });

            // Manejo de errores de validación
            Livewire.on('validation-error', (errors) => {
                console.error('Errores de validación:', errors);
                const errorMessages = Object.values(errors).flat();
                showNotification('Errores de validación: ' + errorMessages.join(', '), 'error');
            });

            // Función para mostrar notificaciones
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 p-3 sm:p-4 rounded-lg shadow-lg z-50 max-w-sm ${
                    type === 'error' ? 'bg-red-600 text-white' : 
                    type === 'success' ? 'bg-green-600 text-white' : 
                    'bg-blue-600 text-white'
                }`;
                notification.innerHTML = `
                    <div class="flex items-center gap-2">
                        <span class="text-xs sm:text-sm">${message}</span>
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-2">×</button>
                    </div>
                `;
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 5000);
            }

            // Debugging para el modal de inventario
            document.addEventListener('click', (e) => {
                if (e.target.matches('[wire\\:click*="selectInventory"]')) {
                    console.log('Botón selectInventory clickeado:', e.target);
                }
            });

            // Debugging para subida de archivos
            document.addEventListener('change', (e) => {
                if (e.target.type === 'file') {
                    const file = e.target.files[0];
                    if (file) {
                        console.log('Archivo seleccionado:', {
                            name: file.name,
                            size: file.size,
                            type: file.type,
                            lastModified: new Date(file.lastModified)
                        });
                        
                        if (file.size > 2 * 1024 * 1024) {
                            showNotification('El archivo es demasiado grande. Máximo 2MB permitido.', 'error');
                            e.target.value = '';
                        }
                        
                        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
                        if (!allowedTypes.includes(file.type)) {
                            showNotification('Tipo de archivo no permitido. Solo se permiten imágenes.', 'error');
                            e.target.value = '';
                        }
                    }
                }
            });
        });

        // Función global para debugging
        window.debugServiceEdit = function() {
            console.log('=== DEBUG SERVICE EDIT ===');
            console.log('Componente Livewire:', Livewire.find('service-edit'));
            console.log('Elementos del DOM:', {
                modalInventory: document.querySelector('[wire\\:click*="openInventoryModal"]'),
                photoForm: document.querySelector('[wire\\:click*="openPhotoForm"]'),
                textareas: document.querySelectorAll('textarea')
            });
        };
    </script>
</div>
