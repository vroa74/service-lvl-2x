{{-- ======================= INICIO: Contenedor Principal Móvil ======================= --}}
<div class="bg-gray-800 rounded-lg mb-1 shadow-xl w-full max-w-full px-2 sm:px-8 mx-auto">
    {{-- ======================= INICIO: Header móvil ======================= --}}
    <div class="p-3 border-b border-gray-700">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <h3 class="text-lg font-medium text-white">
                    📱 Editar Inventario
                </h3>
                <p class="text-xs text-gray-400">Dispositivo: {{ $deviceType }}</p>
            </div>
            <a href="{{ route('inventario.index') }}" class="text-gray-400 hover:text-white transition-colors p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>
    </div>
    {{-- ======================= FIN: Header móvil ======================= --}}

    {{-- ======================= INICIO: Mensajes de éxito y error móviles ======================= --}}
    @if (session()->has('message'))
        <div class="p-3 mb-3 bg-green-600 border border-green-500 rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="text-green-200">✅</span>
                    <p class="text-white font-medium text-sm">{{ session('message') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-green-200 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="p-3 mb-3 bg-red-600 border border-red-500 rounded-lg">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-red-200">❌</span>
                        <p class="text-white font-medium text-sm">Error al guardar:</p>
                    </div>
                    <div class="text-red-100 text-xs whitespace-pre-line">{{ session('error') }}</div>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-red-200 hover:text-white ml-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="p-3 mb-3 bg-red-600 border border-red-500 rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-white font-medium text-sm">Errores de validación:</p>
                    <ul class="text-red-200 text-xs mt-1 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-red-200 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
    {{-- ======================= FIN: Mensajes de éxito y error móviles ======================= --}}

    {{-- ======================= INICIO: Formulario de Edición Móvil ======================= --}}
    <form wire:submit.prevent="saveInventory" class="p-3 sm:p-6 space-y-4">
        {{-- ======================= INICIO: Sección Usuarios Móvil ======================= --}}
        <div class="bg-gray-700 rounded-lg p-3">
            <h4 class="text-white font-medium mb-3 text-sm">👥 Usuarios</h4>
            <div class="space-y-3">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <label class="block text-sm font-medium text-gray-300">
                            Usuario
                        </label>
                        <button type="button" wire:click="openUserModal('user')"
                            class="px-2 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs rounded transition-colors">
                            👤
                        </button>
                    </div>
                    <input wire:model="user" type="text" readonly
                        class="w-full px-3 py-2 bg-gray-600 border border-gray-600 rounded-lg text-white placeholder-gray-400 cursor-not-allowed text-sm"
                        placeholder="Seleccionar usuario">
                    @error('user_id')
                        <span class="text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <label class="block text-sm font-medium text-gray-300">
                            Resguardante
                        </label>
                        <button type="button" wire:click="openUserModal('responsible')"
                            class="px-2 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs rounded transition-colors">
                            🛡️
                        </button>
                    </div>
                    <input wire:model="resguardante" type="text" readonly
                        class="w-full px-3 py-2 bg-gray-600 border border-gray-600 rounded-lg text-white placeholder-gray-400 cursor-not-allowed text-sm"
                        placeholder="Seleccionar resguardante">
                    @error('res_id')
                        <span class="text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Nombre del Resguardante
                    </label>
                    <input wire:model="resguardante_edit" type="text"
                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                        placeholder="Nombre del resguardante">
                    @error('resguardante_edit')
                        <span class="text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        {{-- ======================= FIN: Sección Usuarios Móvil ======================= --}}

        {{-- ======================= INICIO: Información del artículo Móvil ======================= --}}
        <div class="bg-gray-700 rounded-lg p-3">
            <h4 class="text-white font-medium mb-3 text-sm">📦 Artículo</h4>
            <div class="space-y-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Artículo <span class="text-red-400">*</span>
                        </label>
                        <input wire:model.live="articulo" type="text"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm @error('articulo') border-red-500 @enderror"
                            placeholder="Nombre del artículo">
                        @error('articulo')
                            <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Tipo
                        </label>
                        <input wire:model.live="type" type="text"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm @error('type') border-red-500 @enderror"
                            placeholder="Tipo de artículo">
                        @error('type')
                            <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            NI
                        </label>
                        <input wire:model="ni" type="text"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                            placeholder="Número de inventario">
                        @error('ni')
                            <span class="text-red-400 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            NS
                        </label>
                        <input wire:model="ns" type="text"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                            placeholder="Número de serie">
                        @error('ns')
                            <span class="text-red-400 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Marca
                        </label>
                        <input wire:model="marca" type="text"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                            placeholder="Marca del artículo">
                        @error('marca')
                            <span class="text-red-400 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Modelo
                    </label>
                    <input wire:model="modelo" type="text"
                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                        placeholder="Modelo del artículo">
                    @error('modelo')
                        <span class="text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        {{-- ======================= FIN: Información del artículo Móvil ======================= --}}

        {{-- ======================= INICIO: Información de PC Móvil ======================= --}}
        <div class="bg-gray-700 rounded-lg p-3">
            <h4 class="text-white font-medium mb-3 text-sm">💻 Información PC</h4>
            <div class="space-y-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="flex items-center">
                            <input wire:model="is_pc" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                            <span class="ml-2 text-sm text-gray-300">Es PC</span>
                        </label>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Grupo
                        </label>
                        <input wire:model="gpo" type="text"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                            placeholder="Grupo">
                        @error('gpo')
                            <span class="text-red-400 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Dispositivo
                    </label>
                    <input wire:model="disp" type="text"
                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                        placeholder="Dispositivo">
                    @error('disp')
                        <span class="text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        {{-- ======================= FIN: Información de PC Móvil ======================= --}}

        {{-- ======================= INICIO: Información adicional Móvil ======================= --}}
        <div class="bg-gray-700 rounded-lg p-3">
            <h4 class="text-white font-medium mb-3 text-sm">📝 Información Adicional</h4>
            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Observaciones
                    </label>
                    <textarea wire:model="observaciones" rows="3"
                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                        placeholder="Observaciones adicionales"></textarea>
                    @error('observaciones')
                        <span class="text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="flex items-center">
                        <input wire:model="status" type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                        <span class="ml-2 text-sm text-gray-300">Activo</span>
                    </label>
                </div>
            </div>
        </div>
        {{-- ======================= FIN: Información adicional Móvil ======================= --}}

        {{-- ======================= INICIO: Botones de acción móviles ======================= --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-700">
            <a href="{{ route('inventario.index') }}"
                class="flex-1 px-4 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors text-center text-sm font-medium">
                ❌ Cancelar
            </a>
            <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed"
                class="flex-1 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex items-center justify-center gap-2 text-sm font-medium">
                <span wire:loading.remove>💾 Guardar</span>
                <span wire:loading>Guardando...</span>
                <div wire:loading class="animate-spin rounded-full h-4 w-4 border-b-2 border-white"></div>
            </button>
        </div>
        {{-- ======================= FIN: Botones de acción móviles ======================= --}}
    </form>
    {{-- ======================= FIN: Formulario de Edición Móvil ======================= --}}

    {{-- ======================= INICIO: Modal de Usuarios Móvil ======================= --}}
    @if ($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-75 flex items-end sm:items-center justify-center z-50 p-4">
            <div class="bg-gray-800 rounded-lg w-full max-w-sm max-h-[90vh] overflow-y-auto">
                <div class="sticky top-0 bg-gray-800 p-4 border-b border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-white">{{ $modalTitle }}</h3>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="p-4 space-y-4">
                    <div>
                        <input wire:model.live="userSearch" type="text" placeholder="🔍 Buscar usuario..."
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    </div>

                    <div class="space-y-2 max-h-96 overflow-y-auto">
                        @foreach ($users as $user)
                            <button wire:click="selectUser({{ $user->id }}, '{{ $user->name }}')"
                                class="w-full p-3 text-left bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors">
                                <div class="text-white font-medium text-sm">{{ $user->name }}</div>
                                <div class="text-gray-400 text-xs">{{ $user->email }}</div>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- ======================= FIN: Modal de Usuarios Móvil ======================= --}}

    {{-- ======================= INICIO: Scripts optimizados para móvil ======================= --}}
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

            // Optimizaciones adicionales para móvil
            if ('ontouchstart' in window) {
                // Mejorar experiencia táctil
                document.addEventListener('touchstart', function() {}, {passive: true});
                
                // Prevenir zoom en inputs
                document.addEventListener('gesturestart', function(e) {
                    e.preventDefault();
                });
            }
        });
    </script>

    {{-- ======================= INICIO: Estilos específicos para móvil ======================= --}}
    <style>
        @media (max-width: 768px) {
            /* Reducir padding y márgenes */
            .p-6 { padding: 0.75rem; }
            .mb-4 { margin-bottom: 0.75rem; }
            .space-y-6 > * + * { margin-top: 1rem; }
            
            /* Optimizar botones para touch */
            button, a {
                min-height: 44px; /* Tamaño mínimo recomendado para touch */
                touch-action: manipulation;
            }
            
            /* Mejorar scroll */
            .overflow-y-auto {
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
            
            /* Mejorar formularios */
            input, textarea, select {
                font-size: 16px !important; /* Evita zoom en iOS */
            }
        }
        
        /* Soporte para notch */
        @supports (padding: max(0px)) {
            .px-2 {
                padding-left: max(0.5rem, env(safe-area-inset-left));
                padding-right: max(0.5rem, env(safe-area-inset-right));
            }
        }
        
        /* Mejorar contraste en móvil */
        @media (max-width: 768px) {
            .text-gray-300 {
                color: #d1d5db;
            }
            .text-gray-400 {
                color: #9ca3af;
            }
        }
    </style>
    {{-- ======================= FIN: Estilos específicos para móvil ======================= --}}
</div>
{{-- ======================= FIN: Contenedor Principal Móvil ======================= --}}
