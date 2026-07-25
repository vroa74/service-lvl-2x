<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Ejemplo de Uso - DeviceDetector
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border border-gray-700 p-6">
                
                <!-- Información completa del dispositivo -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-200 mb-4">Información Completa del Dispositivo:</h3>
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <pre class="text-green-400 text-sm">{{ json_encode($deviceInfo, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                </div>

                <!-- Uso condicional en Blade -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-200 mb-4">Contenido Condicional:</h3>
                    
                    @if($isMobile)
                        <div class="bg-blue-600 p-4 rounded-lg">
                            <p class="text-white">📱 Este contenido se muestra solo en dispositivos móviles</p>
                        </div>
                    @else
                        <div class="bg-green-600 p-4 rounded-lg">
                            <p class="text-white">🖥️ Este contenido se muestra solo en dispositivos desktop</p>
                        </div>
                    @endif
                </div>

                <!-- Información individual -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-200 mb-4">Información Individual:</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <p class="text-gray-300"><strong>Tipo de Dispositivo:</strong> {{ $deviceType }}</p>
                        </div>
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <p class="text-gray-300"><strong>Es Móvil:</strong> {{ $isMobile ? 'Sí' : 'No' }}</p>
                        </div>
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <p class="text-gray-300"><strong>Es Desktop:</strong> {{ $isDesktop ? 'Sí' : 'No' }}</p>
                        </div>
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <p class="text-gray-300"><strong>User Agent:</strong> {{ Str::limit($userAgent, 50) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Componente visual -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-200 mb-4">Componente Visual:</h3>
                    <x-device-detector />
                </div>

                <!-- Enlaces de ejemplo -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-200 mb-4">Enlaces de Ejemplo:</h3>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('api.device.info') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            API Device Info
                        </a>
                        <a href="{{ route('conditional.content') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                            Contenido Condicional
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout> 