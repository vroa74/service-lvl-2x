<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Servicios') }}
        </h2>
    </x-slot>

    <div class="py-1">

        {{-- Contenido principal con clases responsive --}}
        <livewire:service.index />
        
    </div>

    {{-- Scripts específicos por dispositivo --}}
    @if($isMobile)
        <script>
            // Optimizaciones específicas para móvil
            document.addEventListener('DOMContentLoaded', function() {
                // Reducir animaciones en móvil
                document.body.style.setProperty('--tw-transition-duration', '0.1s');
                
                // Mejorar scroll en móvil
                document.body.style.webkitOverflowScrolling = 'touch';
            });
        </script>
    @endif
</x-app-layout> 