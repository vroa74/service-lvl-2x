<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <input id="email" class="border-gray-600 bg-gray-900 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="rfc" value="{{ __('RFC') }}" />
                <div class="relative">
                    <input type="password" id="rfc" name="rfc" value="{{ old('rfc') }}" class="bg-gray-900 border border-gray-600 text-gray-300 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 pr-10" placeholder="ABCD123456EF7" maxlength="13" required autocomplete="rfc" />
                    <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3" onclick="togglePasswordVisibility('rfc')">
                        <svg id="rfc-icon" class="w-4 h-4 text-gray-400 hover:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                            <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <div class="relative">
                    <input type="password" id="password" name="password" class="bg-gray-900 border border-gray-600 text-gray-300 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 pr-10" required autocomplete="current-password" />
                    <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3" onclick="togglePasswordVisibility('password')">
                        <svg id="password-icon" class="w-4 h-4 text-gray-400 hover:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                            <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-400 hover:text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>

        <!-- Script para mostrar/ocultar caracteres con Flowbite -->
        <script>
            function togglePasswordVisibility(fieldId) {
                const field = document.getElementById(fieldId);
                const icon = document.getElementById(fieldId + '-icon');
                
                console.log('Toggle clicked for:', fieldId);
                
                if (field.type === 'password') {
                    field.type = 'text';
                    // Cambiar a icono de ojo tachado
                    icon.innerHTML = `<path d="m1 1 22 22m-2-2a11.969 11.969 0 0 0 5.74-3.74M12 5c-2.612 0-4.95.981-6.743 2.257l10.999 11c2.646-2.879 4.744-6.644 4.744-10.257 0-1.664-.612-3-1.257-3.743M12 5c-2.612 0-4.95.981-6.743 2.257l10.999 11c2.646-2.879 4.744-6.644 4.744-10.257 0-1.664-.612-3-1.257-3.743M12 5c-2.612 0-4.95.981-6.743 2.257l10.999 11c2.646-2.879 4.744-6.644 4.744-10.257 0-1.664-.612-3-1.257-3.743"/>`;
                } else {
                    field.type = 'password';
                    // Cambiar a icono de ojo normal
                    icon.innerHTML = `<path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>`;
                }
            }

            // Verificar que los botones estén visibles al cargar la página
            document.addEventListener('DOMContentLoaded', function() {
                console.log('Page loaded, checking Flowbite buttons...');
                const rfcButton = document.querySelector('[onclick="togglePasswordVisibility(\'rfc\')"]');
                const passwordButton = document.querySelector('[onclick="togglePasswordVisibility(\'password\')"]');
                
                console.log('RFC button found:', rfcButton);
                console.log('Password button found:', passwordButton);
            });
        </script>
    </x-authentication-card>
</x-guest-layout>

<body style="background: url('https://www.w3schools.com/w3css/img_lights.jpg') no-repeat center center fixed; background-size: cover;">
