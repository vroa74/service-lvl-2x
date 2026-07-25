<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Usuarios - Inventarios') }}
        </h2>
    </x-slot>

    <div class="py-4">
        {{-- Contenido principal con clases responsive --}}
        <div class="{{ $isMobile ? 'px-2' : 'px-6' }}">
            <livewire:inventory.responsables />
        </div>
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
