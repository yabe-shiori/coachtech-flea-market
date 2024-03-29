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
    <header class="text-white body-font">
        <div class="container-fluid flex flex-wrap p-4 flex-col md:flex-row items-start bg-black">
            <a>
                <x-application-logo class="block h-9 w-auto fill-current text-white" />
            </a>
        </div>
    </header>
    <div class="min-h-screen  pt-6 sm:pt-0">
        <div class="w-full mt-6 px-6 py-4 bg-white overflow-hidden">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
