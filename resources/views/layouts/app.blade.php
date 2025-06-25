<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @php
            $favicons = ['favicon_1.png', 'favicon_2.png', 'favicon_3.png', 'favicon_4.png', 'favicon_5.png', 'favicon_6.png', 'favicon_7.png'];
            $randomFavicon = $favicons[array_rand($favicons)];
        @endphp
        <link rel="icon" type="image/png" href="{{ asset($randomFavicon) }}?v={{ time() }}">
        

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href=" https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.min.css " rel="stylesheet">
        

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    </head>
    <body class="font-sans antialiased bg-gray-900 text-gray-100">
        <x-banner />

        <div class="min-h-screen bg-gray-900">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-gray-800 border-b border-steal-900 shadow-lg">
                    <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
                        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                            {{ $header }}
                        </h2>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="bg-gray-900">
                {{ $slot }}
            </main>
        </div>
        @stack('modals')
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script> --}}
        @livewireScripts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    </body>
</html>
