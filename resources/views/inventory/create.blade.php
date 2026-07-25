<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Crear Inventario') }}
        </h2>
    </x-slot>

    <div class="py-4">
        {{-- Contenido principal con clases responsive --}}
        <div class="{{ $isMobile ? 'px-2' : 'px-6' }}">
            @if($isMobile)
                {{-- Componente móvil optimizado --}}
                @livewire('inventory.mcreate')
            @else
                {{-- Componente desktop --}}
                @livewire('inventory.create')
            @endif
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
