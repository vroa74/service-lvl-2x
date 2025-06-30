<div>
    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div 
            x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 5000)" 
            x-show="show"
            x-transition
            class="mb-4 p-4 bg-green-600 text-white rounded-lg flex items-center justify-between"
        >
            <span>{{ session('message') }}</span>
            <button type="button" class="text-white hover:text-gray-200" @click="show = false">
                <x-lucide name="x" class="w-5 h-5" />
            </button>
        </div>
    @endif

    <!-- Mensaje de error -->
    @if (session()->has('error'))
        <div 
            x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 5000)" 
            x-show="show"
            x-transition
            class="mb-4 p-4 bg-red-600 text-white rounded-lg flex items-center justify-between"
        >
            <span>{{ session('error') }}</span>
            <button type="button" class="text-white hover:text-gray-200" @click="show = false">
                <x-lucide name="x" class="w-5 h-5" />
            </button>
        </div>
    @endif

    <!-- Barra de búsqueda y botón agregar -->
    <div class="flex flex-col sm:flex-row gap-4 mb-4">
        <div class="flex-1">
            <div class="relative">
                <x-lucide name="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" />
                <input 
                    wire:model.live="search" 
                    type="text" 
                    placeholder="Buscar usuarios..." 
                    class="w-full pl-10 pr-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
            </div>
        </div>
        <div class="flex gap-2">
            <button 
                wire:click="openModal"
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center gap-2 transition-colors"
            >
                <x-lucide name="plus" class="w-5 h-5" />
                Agregar Usuario
            </button>
        </div>
    </div>

    <!-- Tabla de usuarios -->
    <div class="bg-gray-800 rounded-3xl overflow-hidden shadow-lg border border-gray-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700 rounded-3xl overflow-hidden">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-[20%] rounded-tl-3xl">
                            Usuario
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-[12%]">
                            RFC
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-[25%]">
                            Dirección / Posición
                        </th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider w-[12%]">
                            Sexo
                        </th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider w-[8%]">
                            Nivel
                        </th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider w-[12%]">
                            Tipo
                        </th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider w-[8%]">
                            Estado
                        </th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider w-[8%] rounded-tr-3xl">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-700 transition-colors">
                            <td class="px-3 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-6 w-6">
                                        @if($user->profile_photo_url)
                                            <img class="h-6 w-6 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                        @else
                                            <div class="h-6 w-6 rounded-full bg-gray-600 flex items-center justify-center">
                                                <x-lucide name="user" class="w-4 h-4 text-gray-300" />
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-xs font-medium text-white"> id: {{ $user->id }}</div>
                                        <div class="text-sm font-medium text-white"> nombre: {{ $user->name }}</div>
                                        <div class="text-sm text-gray-400"> email: {{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-300">
                                rfc: {{ $user->rfc ?? 'N/A' }}
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-300">
                                <div class="max-w-md">
                                    @if($user->direction)
                                        <div class="font-medium text-white" title="{{ $user->direction }}">
                                            dir: {{ Str::limit($user->direction, 50) }}
                                        </div>
                                    @endif
                                    @if($user->position)
                                        <div class="text-gray-400 text-xs" title="{{ $user->position }}">
                                            pos: {{ Str::limit($user->position, 50) }}
                                        </div>
                                    @endif
                                    @if(!$user->direction && !$user->position)
                                        <span class="text-gray-500">N/A</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-3 py-4 text-center">
                                @if($user->sex)
                                    <div class="flex items-center justify-center gap-2">
                                        @if($user->sex === 'masculino')
                                            <button 
                                                wire:click="toggleSex({{ $user->id }})"
                                                class="flex items-center gap-1 px-2 py-1 rounded-full bg-blue-100 hover:bg-blue-200 transition-colors cursor-pointer"
                                                title="Haz clic para cambiar a Femenino"
                                            >
                                                <x-lucide name="male" class="w-4 h-4 text-black" />
                                                <span class="text-xs font-medium text-black">Masculino</span>
                                            </button>
                                        @else
                                            <button 
                                                wire:click="toggleSex({{ $user->id }})"
                                                class="flex items-center gap-1 px-2 py-1 rounded-full bg-pink-100 hover:bg-pink-200 transition-colors cursor-pointer"
                                                title="Haz clic para cambiar a Masculino"
                                            >
                                                <x-lucide name="female" class="w-4 h-4 text-black" />
                                                <span class="text-xs font-medium text-black">Femenino</span>
                                            </button>
                                        @endif
                                    </div>
                                @else
                                    <button 
                                        wire:click="toggleSex({{ $user->id }})"
                                        class="flex items-center gap-1 px-2 py-1 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors cursor-pointer"
                                        title="Haz clic para establecer como Masculino"
                                    >
                                        <x-lucide name="male" class="w-4 h-4 text-black" />
                                        <span class="text-xs font-medium text-black">Establecer</span>
                                    </button>
                                @endif
                            </td>
                            <td class="px-3 py-4 text-center text-sm text-gray-300">
                                lvl: {{ $user->lvl ?? 'N/A' }}
                            </td>
                            <td class="px-3 py-4 text-center">
                                @switch($user->tipo)
                                    @case(1)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Administrador
                                        </span>
                                        @break
                                    @case(2)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            En Servicio Técnico
                                        </span>
                                        @break
                                    @case(3)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Usuario
                                        </span>
                                        @break
                                    @default
                                        <span class="text-gray-500">N/A</span>
                                @endswitch
                            </td>
                            <td class="px-3 py-4 text-center">
                                @if($user->status)
                                    <button 
                                        wire:click="toggleStatus({{ $user->id }})"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 hover:bg-green-200 transition-colors cursor-pointer"
                                        title="Haz clic para desactivar"
                                    >
                                        Activo
                                    </button>
                                @else
                                    <button 
                                        wire:click="toggleStatus({{ $user->id }})"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-black hover:bg-gray-200 transition-colors cursor-pointer"
                                        title="Haz clic para activar"
                                    >
                                        Inactivo
                                    </button>
                                @endif
                            </td>
                            <td class="px-3 py-4 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <button 
                                        wire:click="editUser({{ $user->id }})"
                                        class="text-blue-400 hover:text-blue-300 transition-colors"
                                        title="Editar"
                                    >
                                        <x-lucide name="edit" class="w-4 h-4" />
                                    </button>
                                    {{-- <button 
                                        wire:click="toggleStatus({{ $user->id }})"
                                        class="text-yellow-400 hover:text-yellow-300 transition-colors"
                                        title="{{ $user->status ? 'Desactivar' : 'Activar' }}"
                                    >
                                        <x-lucide name="toggle-left" class="w-4 h-4" />
                                    </button> --}}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-3 py-12 text-center text-gray-400">
                                <x-lucide name="users" class="w-12 h-12 mx-auto mb-4 text-gray-600" />
                                <p class="text-lg">No se encontraron usuarios</p>
                                <p class="text-sm">Comienza agregando un nuevo usuario</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Paginación -->
        @if($users->hasPages())
            <div class="px-3 py-4 bg-gray-700 border-t border-gray-600">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <!-- Modal de Usuario -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-white">
                            {{ $editing ? 'Editar Usuario' : 'Nuevo Usuario' }}
                        </h3>
                        <button 
                            wire:click="closeModal"
                            class="text-gray-400 hover:text-white transition-colors"
                        >
                            <x-lucide name="x" class="w-6 h-6" />
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="saveUser" class="p-6 space-y-6">
                    <!-- Nombre -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                            Nombre Completo *
                        </label>
                        <input 
                            wire:model="name"
                            type="text" 
                            id="name"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Ingrese el nombre completo"
                        >
                        @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Foto de Perfil -->
                    <div x-data="{photoName: null, photoPreview: null}">
                        <label for="photo" class="block text-sm font-medium text-gray-300 mb-2">
                            Foto de Perfil
                        </label>
                        
                        <!-- Input de archivo oculto -->
                        <input 
                            type="file" 
                            id="photo" 
                            class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            accept="image/*"
                            x-on:change="
                                if ($refs.photo.files[0]) {
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                                }
                            "
                        />

                        <!-- Foto actual (solo en edición) -->
                        @if($editing && $userId)
                            @php
                                $currentUser = \App\Models\User::find($userId);
                            @endphp
                            <div class="mt-2" x-show="! photoPreview">
                                @if($currentUser && $currentUser->profile_photo_url)
                                    <img src="{{ $currentUser->profile_photo_url }}" alt="{{ $currentUser->name }}" class="rounded-full size-20 object-cover">
                                @else
                                    <div class="rounded-full size-20 bg-gray-600 flex items-center justify-center">
                                        <x-lucide name="user" class="w-8 h-8 text-gray-300" />
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Vista previa de la nueva foto -->
                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                            <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center"
                                  x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>

                        <!-- Botones -->
                        <div class="mt-2 flex gap-2">
                            <button 
                                type="button" 
                                x-on:click.prevent="$refs.photo.click()"
                                class="px-3 py-1 bg-gray-600 hover:bg-gray-500 text-white text-sm rounded-lg transition-colors"
                            >
                                {{ $editing ? 'Cambiar Foto' : 'Seleccionar Foto' }}
                            </button>
                            
                            @if($editing && $userId && $currentUser && $currentUser->profile_photo_path)
                                <button 
                                    type="button" 
                                    wire:click="deleteProfilePhoto"
                                    class="px-3 py-1 bg-red-600 hover:bg-red-500 text-white text-sm rounded-lg transition-colors"
                                >
                                    Eliminar Foto
                                </button>
                            @endif
                        </div>

                        @error('photo') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                            Email *
                        </label>
                        <input 
                            wire:model="email"
                            type="email" 
                            id="email"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="ejemplo@correo.com"
                        >
                        @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- RFC -->
                    <div>
                        <label for="rfc" class="block text-sm font-medium text-gray-300 mb-2">
                            RFC
                        </label>
                        <input 
                            wire:model="rfc"
                            type="text" 
                            id="rfc"
                            maxlength="13"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Ingrese el RFC (opcional)"
                        >
                        @error('rfc') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Dirección -->
                    <div>
                        <label for="direction" class="block text-sm font-medium text-gray-300 mb-2">
                            Dirección
                        </label>
                        <div class="flex gap-2">
                            <select 
                                wire:model="direction"
                                id="direction"
                                class="flex-1 px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                x-on:change="
                                    if ($event.target.value === '__new__') {
                                        $event.target.value = '';
                                        $wire.set('direction', '');
                                        $refs.newDirectionInput.style.display = 'block';
                                        $refs.newDirectionInput.focus();
                                    } else {
                                        $refs.newDirectionInput.style.display = 'none';
                                    }
                                "
                            >
                                <option value="">Seleccionar dirección...</option>
                                @foreach($uniqueDirections as $dir)
                                    <option value="{{ $dir }}">{{ $dir }}</option>
                                @endforeach
                                <option value="__new__">+ Agregar nueva dirección</option>
                            </select>
                        </div>
                        
                        <!-- Campo de texto para nueva dirección -->
                        <div class="mt-2" x-ref="newDirectionInput" style="display: none;">
                            <input 
                                type="text" 
                                id="new_direction"
                                placeholder="Escribir nueva dirección..."
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                x-on:input="$wire.set('direction', $event.target.value)"
                            >
                        </div>
                        
                        @error('direction') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Posición y Sexo -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-300 mb-2">
                                Posición
                            </label>
                            <select 
                                wire:model="position"
                                id="position"
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                x-on:change="
                                    if ($event.target.value === '__new__') {
                                        $event.target.value = '';
                                        $wire.set('position', '');
                                        $wire.set('lvl', '');
                                        $refs.newPositionInput.style.display = 'block';
                                        $refs.newPositionInput.focus();
                                    } else {
                                        $refs.newPositionInput.style.display = 'none';
                                    }
                                "
                            >
                                <option value="">Seleccionar posición...</option>
                                @foreach($uniquePositions as $pos)
                                    <option value="{{ $pos }}">{{ $pos }}</option>
                                @endforeach
                                <option value="__new__">+ Agregar nueva posición</option>
                            </select>
                            <!-- Campo de texto para nueva posición -->
                            <div class="mt-2" x-ref="newPositionInput" style="display: none;">
                                <input 
                                    type="text" 
                                    id="new_position"
                                    placeholder="Escribir nueva posición..."
                                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    x-on:input="$wire.set('position', $event.target.value)"
                                >
                            </div>
                            @error('position') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="sex" class="block text-sm font-medium text-gray-300 mb-2">
                                Sexo
                            </label>
                            <select 
                                wire:model="sex"
                                id="sex"
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                                <option value="">Seleccionar...</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                            </select>
                            @error('sex') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Nivel y Tipo -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="lvl" class="block text-sm font-medium text-gray-300 mb-2">
                                Nivel (Automático)
                            </label>
                            <input 
                                wire:model="lvl"
                                type="text" 
                                id="lvl"
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Ingrese el nivel"
                            >
                            <p class="text-xs text-gray-500 mt-1">Puede editar el nivel manualmente</p>
                            @error('lvl') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="tipo" class="block text-sm font-medium text-gray-300 mb-2">
                                Tipo de Usuario
                            </label>
                            <select 
                                wire:model="tipo"
                                id="tipo"
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                                <option value="1">Administrador</option>
                                <option value="2">En Servicio Técnico</option>
                                <option value="3">Usuario</option>
                            </select>
                            @error('tipo') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Contraseña -->
                    @if(!$editing)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                                    Contraseña *
                                </label>
                                <input 
                                    wire:model="password"
                                    type="password" 
                                    id="password"
                                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Mínimo 8 caracteres"
                                >
                                @error('password') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">
                                    Confirmar Contraseña *
                                </label>
                                <input 
                                    wire:model="password_confirmation"
                                    type="password" 
                                    id="password_confirmation"
                                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Confirme la contraseña"
                                >
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                                    Nueva Contraseña (opcional)
                                </label>
                                <input 
                                    wire:model="password"
                                    type="password" 
                                    id="password"
                                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Dejar vacío para mantener"
                                >
                                @error('password') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">
                                    Confirmar Nueva Contraseña
                                </label>
                                <input 
                                    wire:model="password_confirmation"
                                    type="password" 
                                    id="password_confirmation"
                                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Confirme la nueva contraseña"
                                >
                            </div>
                        </div>
                    @endif

                    <!-- Estado -->
                    <div class="flex items-center">
                        <input 
                            wire:model="status"
                            type="checkbox" 
                            id="status"
                            class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                        >
                        <label for="status" class="ml-2 text-sm text-gray-300">
                            Usuario activo
                        </label>
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-700">
                        <button 
                            type="button"
                            wire:click="closeModal"
                            class="px-4 py-2 text-gray-300 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors"
                        >
                            Cancelar
                        </button>
                        <button 
                            type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex items-center gap-2"
                        >
                            <x-lucide name="save" class="w-4 h-4" />
                            {{ $editing ? 'Actualizar' : 'Crear' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('showMessage', message => {
            window.dispatchEvent(new CustomEvent('show-livewire-message', { detail: { message } }));
        });
    });

    window.addEventListener('show-livewire-message', event => {
        const msg = event.detail.message;
        let div = document.createElement('div');
        div.className = 'fixed top-6 left-1/2 transform -translate-x-1/2 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50';
        div.textContent = msg;
        document.body.appendChild(div);
        setTimeout(() => {
            div.style.transition = 'opacity 0.5s';
            div.style.opacity = '0';
            setTimeout(() => div.remove(), 500);
        }, 5000);
    });
</script>
