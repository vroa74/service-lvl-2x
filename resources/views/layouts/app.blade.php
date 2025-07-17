<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @php
            $favicons = [];
            for ($i = 1; $i <= 24; $i++) {
                $favicons[] = "img/{$i}.png";
            }
            $randomFavicon = $favicons[array_rand($favicons)];
        @endphp
        <link rel="icon" type="image/png" href="{{ asset($randomFavicon) }}?v={{ time() }}">
        

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href=" https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.min.css " rel="stylesheet">
        <!-- CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
        <!-- CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
        <!-- CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/notie/4.3.1/notie.min.css" rel="stylesheet" />
        <!-- JS -->






        

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    </head>
    <body class="font-sans antialiased bg-gray-900 text-gray-100">
        <x-banner />

        <div class="min-h-screen bg-gray-900">
            <div class="fixed top-0 left-0 right-0 z-50 h-16">
                @livewire('navigation-menu')
            </div>
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-gray-800 border-b border-steal-900 shadow-lg fixed top-16 left-0 right-0 z-40">
                    <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
                        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                            {{ $header }}
                        </h2>
                    </div>
                </header>
            @endif
            <!-- Page Content -->
            <main class="bg-gray-900 @if(isset($header)) pt-32 @else pt-16 @endif">
                {{ $slot }}
            </main>



            
        </div>
        @stack('modals')
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script> --}}
        @livewireScripts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/notie/4.3.1/notie.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script type="module"> import lucide from 'https://cdn.jsdelivr.net/npm/lucide@0.525.0/+esm' </script>
        // <script type="module"> import lucide from https://cdn.jsdelivr.net/npm/lucide@0.525.0/+esm </script>

    </body>
</html>
