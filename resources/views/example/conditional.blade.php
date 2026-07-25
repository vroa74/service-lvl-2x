<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Contenido Condicional - DeviceDetector
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border border-gray-700 p-6">
                
                <!-- Contenido basado en el dispositivo -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-200 mb-4">Contenido Dinámico:</h3>
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <p class="text-white">{{ $content }}</p>
                    </div>
                </div>

                <!-- Ejemplos de uso directo del componente -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-200 mb-4">Uso Directo del Componente:</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Verificación de tipo de dispositivo -->
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-300 mb-2">Verificación de Dispositivo:</h4>
                            @if($deviceDetector->isMobileDevice())
                                <p class="text-blue-400">📱 Dispositivo móvil detectado</p>
                            @else
                                <p class="text-green-400">🖥️ Dispositivo desktop detectado</p>
                            @endif
                        </div>

                        <!-- Información del breakpoint -->
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-300 mb-2">Breakpoint:</h4>
                            <p class="text-yellow-400">Breakpoint: {{ $deviceDetector->getBreakpoint() }}</p>
                        </div>

                        <!-- Escala de pantalla -->
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-300 mb-2">Escala:</h4>
                            <p class="text-purple-400">Escala: {{ $deviceDetector->getScale() }}x</p>
                        </div>

                        <!-- Dimensiones de pantalla -->
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-300 mb-2">Dimensiones:</h4>
                            <p class="text-orange-400">{{ $deviceDetector->getScreenWidth() }} x {{ $deviceDetector->getScreenHeight() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Contenido específico por dispositivo -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-200 mb-4">Contenido Específico:</h3>
                    
                    @if($deviceDetector->isMobileDevice())
                        <!-- Contenido para móvil -->
                        <div class="bg-blue-600 p-4 rounded-lg">
                            <h4 class="text-white font-semibold mb-2">Optimizado para Móvil:</h4>
                            <ul class="text-white text-sm space-y-1">
                                <li>• Botones más grandes para toque</li>
                                <li>• Navegación simplificada</li>
                                <li>• Contenido apilado verticalmente</li>
                                <li>• Carga optimizada para conexiones móviles</li>
                            </ul>
                        </div>
                    @else
                        <!-- Contenido para desktop -->
                        <div class="bg-green-600 p-4 rounded-lg">
                            <h4 class="text-white font-semibold mb-2">Optimizado para Desktop:</h4>
                            <ul class="text-white text-sm space-y-1">
                                <li>• Navegación horizontal completa</li>
                                <li>• Múltiples columnas de contenido</li>
                                <li>• Hover effects y interacciones avanzadas</li>
                                <li>• Funcionalidades de teclado y mouse</li>
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Información JSON -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-200 mb-4">Información JSON:</h3>
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <pre class="text-green-400 text-sm">{{ $deviceDetector->getDeviceInfoJson() }}</pre>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout> 