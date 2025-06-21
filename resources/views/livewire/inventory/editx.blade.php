<div class="bg-gray-800 rounded-lg shadow-xl w-full max-w-4xl mx-auto">
    <div class="p-6 border-b border-gray-700">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-white">
                Editar Servicio
            </h3>
            <a href="{{ route('servicios.index') }}"
                class="text-gray-400 hover:text-white transition-colors"
            >
                <x-lucide name="x" class="w-6 h-6" />
            </a>
        </div>
    </div>

    <form wire:submit.prevent="updateService" class="p-6 space-y-6">
        <!-- Información básica -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="id_s" class="block text-sm font-medium text-gray-300 mb-2">
                    ID Servicio
                </label>
                <input 
                    wire:model="id_s"
                    type="text" 
                    id="id_s"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="ID del servicio"
                >
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

        <!-- Usuarios involucrados -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="solicitante1_id" class="block text-sm font-medium text-gray-300 mb-2">
                    Solicitante 1
                </label>
                <select 
                    wire:model="solicitante1_id"
                    id="solicitante1_id"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                    <option value="">Seleccionar...</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('solicitante1_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="solicitante2_id" class="block text-sm font-medium text-gray-300 mb-2">
                    Solicitante 2
                </label>
                <select 
                    wire:model="solicitante2_id"
                    id="solicitante2_id"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                    <option value="">Seleccionar...</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('solicitante2_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="efectuo_id" class="block text-sm font-medium text-gray-300 mb-2">
                    Efectuó
                </label>
                <select 
                    wire:model="efectuo_id"
                    id="efectuo_id"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                    <option value="">Seleccionar...</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('efectuo_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="vobo_id" class="block text-sm font-medium text-gray-300 mb-2">
                    VºBº
                </label>
                <select 
                    wire:model="vobo_id"
                    id="vobo_id"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                    <option value="">Seleccionar...</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('vobo_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Descripción del servicio -->
        <div>
            <label for="obj_sol" class="block text-sm font-medium text-gray-300 mb-2">
                Objetivo de la Solicitud
            </label>
            <textarea 
                wire:model="obj_sol"
                id="obj_sol"
                rows="3"
                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Describa el objetivo de la solicitud"
            ></textarea>
            @error('obj_sol') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="actividades" class="block text-sm font-medium text-gray-300 mb-2">
                Actividades Realizadas
            </label>
            <textarea 
                wire:model="actividades"
                id="actividades"
                rows="3"
                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Describa las actividades realizadas"
            ></textarea>
            @error('actividades') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="mantenimiento" class="block text-sm font-medium text-gray-300 mb-2">
                Mantenimiento
            </label>
            <textarea 
                wire:model="mantenimiento"
                id="mantenimiento"
                rows="2"
                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Detalles de mantenimiento"
            ></textarea>
            @error('mantenimiento') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="observaciones" class="block text-sm font-medium text-gray-300 mb-2">
                Observaciones
            </label>
            <textarea 
                wire:model="observaciones"
                id="observaciones"
                rows="2"
                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Observaciones adicionales"
            ></textarea>
            @error('observaciones') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Tipo de servicio -->
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-3">
                Tipo de Servicio
            </label>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
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
        </div>

        <!-- Via de solicitud -->
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-3">
                Via de Solicitud
            </label>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
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
                        wire:model="calendario"
                        type="checkbox" 
                        class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                    >
                    <span class="ml-2 text-sm text-gray-300">Calendario</span>
                </label>
            </div>
        </div>

        <!-- Información adicional -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="capturo" class="block text-sm font-medium text-gray-300 mb-2">
                    Capturó
                </label>
                <input 
                    wire:model="capturo"
                    type="text" 
                    id="capturo"
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Nombre de quien capturó"
                >
                @error('capturo') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Estados -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <label class="flex items-center">
                <input 
                    wire:model="estatus_servicio"
                    type="checkbox" 
                    class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                >
                <span class="ml-2 text-sm text-gray-300">Servicio activo</span>
            </label>
            <label class="flex items-center">
                <input 
                    wire:model="impressions"
                    type="checkbox" 
                    class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                >
                <span class="ml-2 text-sm text-gray-300">Impresiones</span>
            </label>
        </div>

        <!-- Botones -->
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
                Actualizar Servicio
            </button>
        </div>
    </form>
</div> 