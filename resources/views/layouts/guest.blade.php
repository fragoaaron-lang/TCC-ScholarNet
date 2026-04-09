<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col md:flex-row">
            <!-- Left side - Forms -->
            <div class="w-full md:w-1/2 flex flex-col justify-center items-center bg-gray-50 px-4 py-8 sm:px-6 md:px-8 md:py-0">
                <!-- Mobile logo -->
                <div class="md:hidden mb-8">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </div>

                <div class="w-full max-w-sm bg-white shadow-lg rounded-lg">
                    <div class="p-6 sm:p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <!-- Right side - Logo and Design -->
            <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-indigo-600 to-indigo-800 items-center justify-center p-8">
                <div class="text-center text-white">
                    <x-application-logo class="w-32 h-32 mx-auto mb-8" />
                    <h1 class="text-4xl font-bold mb-4">Welcome to ScholarNet</h1>
                    <p class="text-xl opacity-90">Your gateway to academic excellence</p>
                </div>
            </div>
        </div>
    </body>
</html>
