<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Servicio') }} #{{ $id }}
        </h2>
    </x-slot>

    <div class="py-4">
        {{-- Contenido principal con clases responsive --}}
        <livewire:service.edit :id="$id" />
    </div>

    {{-- Scripts específicos por dispositivo --}} 
     @if($isMobile)
        <script>
            // Optimizaciones específicas para móvil en formularios de edición
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
                
                // Optimizar modales para móvil
                const modals = document.querySelectorAll('.modal, [role="dialog"]');
                modals.forEach(modal => {
                    modal.style.maxHeight = '90vh';
                    modal.style.overflowY = 'auto';
                });
            });
        </script>
    @endif
</x-app-layout> 