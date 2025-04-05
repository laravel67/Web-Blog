<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Laravel, JavaScript, PHP, CodeIgniter, Web Developer, Coding">
    {!! SEO::generate(true) !!}
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @stack('css')

    <style>
        #loading {
            transition: opacity 0.4s ease;
        }

        #loading.hidden {
            opacity: 0;
            pointer-events: none;
        }
    </style>
</head>

<body>
    <!-- Fullscreen Loading Spinner -->
    <div id="loading" class="fixed inset-0 z-50 bg-primary bg-opacity-75 flex items-center justify-center">
        <i class="fas fa-circle-notch fa-spin text-white text-5xl"></i>
    </div>

    <div class="w-full">
        <x-header />
        <div class="w-full px-8 lg:px-12 xl:px-67 md:px-14">
            {{ $slot }}
        </div>
    </div>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @stack('js')

    <script>
        window.addEventListener('load', () => {
            const loader = document.getElementById('loading');
            loader.classList.add('hidden');
        });
    </script>
</body>

</html>