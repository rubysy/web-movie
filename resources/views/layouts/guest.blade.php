<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Cineflix</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
        <body class="font-sans text-develobe-600 antialiased">
            <!-- Header -->
        <div class="w-full bg-develobe-900 h-[96px] drop-shadow-lg flex flex-row items-center">
            <div class="w-1/3 flex items-center justify-center">
                <a href="/" class="font-bold text-5xl font-quicksand text-develobe-400">CINEFLIX</a>
            </div>
        </div>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-10 sm:pt-0 bg-develobe-900">
            <!-- Login Form -->
            <div id="login-section" class="w-full sm:max-w-md px-6 py-4 bg-develobe-700 shadow-md overflow-hidden sm:rounded-lg mt-16">
                <h2 class="text-center font-quicksand text-develobe-400 text-2xl font-bold mb-6">CINEFLIX</h2>
                {{ $slot }}
            </div>

        @include('footer')
    </body>
</html>
