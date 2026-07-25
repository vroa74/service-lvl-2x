<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nuevo Servicio') }}
        </h2>
    </x-slot>

    <div class="py-4">
        {{-- Información del dispositivo (solo visible en desarrollo) --}}
        {{-- @if(config('app.debug'))
            <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-800 rounded-lg border">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    📱 Información del Dispositivo:
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 text-xs">
                    <div>
                        <span class="font-medium">Tipo:</span> 
                        <span class="text-blue-600 dark:text-blue-400">{{ $deviceType }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Es Móvil:</span> 
                        <span class="{{ $isMobile ? 'text-green-600' : 'text-red-600' }}">
                            {{ $isMobile ? 'Sí' : 'No' }}
                        </span>
                    </div>
                    <div>
                        <span class="font-medium">Breakpoint:</span> 
                        <span class="text-purple-600 dark:text-purple-400">{{ $breakpoint }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Escala:</span> 
                        <span class="text-orange-600 dark:text-orange-400">{{ $scale }}x</span>
                    </div>
                    <div>
                        <span class="font-medium">Ancho:</span> 
                        <span class="text-gray-600 dark:text-gray-400">{{ $screenWidth }}px</span>
                    </div>
                    <div>
                        <span class="font-medium">Alto:</span> 
                        <span class="text-gray-600 dark:text-gray-400">{{ $screenHeight }}px</span>
                    </div>
                </div>
            </div>
        @endif --}}

        {{-- Contenido principal con clases responsive --}}
        <div class="{{ $isMobile ? 'px-2' : 'px-6' }}">
            <livewire:service.create />
        </div>
    </div>

    {{-- Scripts específicos por dispositivo --}}
    @if($isMobile)
        <script>
            // Optimizaciones específicas para móvil en formularios
            document.addEventListener('DOMContentLoaded', function() {
                // Reducir animaciones en móvil
                document.body.style.setProperty('--tw-transition-duration', '0.1s');
                
                // Mejorar scroll en móvil
                document.body.style.webkitOverflowScrolling = 'touch';
                
                // Optimizar inputs para móvil
                const inputs = document.querySelectorAll('input, textarea, select');
                inputs.forEach(input => {
                    input.style.fontSize = '16px'; // Evita zoom en iOS
                    input.style.touchAction = 'manipulation';
                });
            });
        </script>
    @endif
</x-app-layout> 