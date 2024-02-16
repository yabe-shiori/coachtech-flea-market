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

    <script src="https://kit.fontawesome.com/2a628c72fd.js" crossorigin="anonymous"></script>
     <script src="https://js.stripe.com/v3/"></script>
</head>

<body class="font-sans antialiased">
    {{-- <div class="min-h-screen bg-white"> --}}
        @if (auth('admin')->user())
            @include('layouts.admin-navigation')
        @else
            @include('layouts.user-navigation')
        @endif

        <!-- Page Heading -->
        @if (isset($subheader))
            <header class="bg-white shadow border-b-2 border-gray-400">
                <div class="max-w-7xl mx-auto pt-4 px-4 sm:px-6 lg:px-8">
                    {{ $subheader }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    {{-- </div> --}}
</body>

</html>
