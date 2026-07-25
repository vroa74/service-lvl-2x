<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border border-gray-700">
                <x-welcome />
                
                <!-- Información del dispositivo sin estilos -->
                <div class="p-6">
                    <h3>Información del Dispositivo:</h3>
                    
                    <p>Tipo: {{ $deviceType }}</p>
                    <p>Es Móvil: {{ $isMobile ? 'Sí' : 'No' }}</p>
                    <p>Es Desktop: {{ $isDesktop ? 'Sí' : 'No' }}</p>
                    <p>Breakpoint: {{ $breakpoint }}</p>
                    <p>Escala: {{ $scale }}x</p>
                    <p>Ancho: {{ $screenWidth }}px</p>
                    <p>Alto: {{ $screenHeight }}px</p>
                    <p>User Agent: {{ $userAgent }}</p>
                    
                    <h4>Información Completa:</h4>
                    <pre>{{ json_encode($deviceInfo, JSON_PRETTY_PRINT) }}</pre>
                    
                    <h4>Componente Visual:</h4>
                    
                    <x-device-detector />
                </div>
            </div>
        </div>
    </div>

    <!-- Script para SweetAlert de actualización de perfil -->
    @if(session('profile_updated'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: '{{ session('profile_updated') }}',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6',
                    background: '#1f2937',
                    color: '#f9fafb',
                    backdrop: 'rgba(0,0,0,0.4)'
                });
            });
        </script>
    @endif
</x-app-layout>
