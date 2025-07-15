@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))

@section('content')
<div class="flex items-center pt-8 sm:justify-start sm:pt-0">
    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
        @yield('code')
    </div>

    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
        @yield('message')
    </div>
</div>

<!-- Script para redirección automática -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Verificar si el usuario está autenticado
    const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
    
    // Redirigir automáticamente después de 3 segundos
    setTimeout(function() {
        if (isAuthenticated) {
            // Si está logueado, ir al dashboard
            window.location.href = '{{ route("dashboard") }}';
        } else {
            // Si no está logueado, ir al inicio
            window.location.href = '{{ url("/") }}';
        }
    }, 3000);
    
    // Mostrar contador regresivo
    let countdown = 3;
    const countdownElement = document.createElement('div');
    countdownElement.className = 'mt-4 text-sm text-gray-400';
    countdownElement.innerHTML = `Redirigiendo en <span id="countdown">${countdown}</span> segundos...`;
    
    // Insertar el contador después del mensaje
    const messageDiv = document.querySelector('.ml-4');
    messageDiv.parentNode.insertBefore(countdownElement, messageDiv.nextSibling);
    
    // Actualizar contador
    const countdownInterval = setInterval(function() {
        countdown--;
        document.getElementById('countdown').textContent = countdown;
        
        if (countdown <= 0) {
            clearInterval(countdownInterval);
        }
    }, 1000);
});
</script>
@endsection
