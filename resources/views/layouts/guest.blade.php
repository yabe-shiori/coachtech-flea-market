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
        <div class="container-fluid flex flex-wrap p-5 flex-col md:flex-row items-center bg-black">
            <a class="flex title-font font-medium items-center text-white mb-4 md:mb-0">
                <svg width="63" height="36" viewBox="0 0 63 36" fill="none"
                    xmlns="http://www.w3.org/2000/svg" class="mr-2">
                    <path
                        d="M56.6901 0H22.2601C12.3301 0 2.55007 8.06 0.420066 18C-1.71993 27.94 4.60007 36 14.5201 36H25.4101C26.8801 36 28.3301 34.81 28.6501 33.33L30.1701 26.27C30.4901 24.8 29.5501 23.6 28.0801 23.6H15.9701C13.2101 23.6 11.2601 21.47 11.7701 18.71C12.3001 15.85 15.0901 13.51 17.9301 13.51H36.9701C38.4401 13.51 39.3801 14.7 39.0601 16.18L35.3701 33.34C35.0501 34.81 35.9901 36.01 37.4601 36.01H46.2901C47.7601 36.01 49.2101 34.82 49.5301 33.34L53.2201 16.18C53.5401 14.71 54.9901 13.51 56.4601 13.51C57.9301 13.51 59.3801 12.32 59.7001 10.84L62.0301 0H56.7001L56.6901 0Z"
                        fill="white" />
                </svg>
                <svg width="302" height="35" viewBox="0 0 302 35" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M31.11 24.0499C29.79 30.3799 25.03 34.9999 16.55 34.9999C5.81001 34.9999 0.76001 27.3899 0.76001 17.7699C0.76001 8.14994 6.01001 0.189941 16.89 0.189941C25.91 0.189941 30.27 5.43994 31.11 11.1399H23.81C23.07 8.48994 21.26 5.88994 16.65 5.88994C10.62 5.88994 8.32001 11.3399 8.32001 17.5299C8.32001 23.2299 10.33 29.2599 16.85 29.2599C21.65 29.2599 23.12 26.0699 23.76 24.0599H31.11V24.0499Z"
                        fill="white" />
                    <path
                        d="M68.4599 17.4699C68.4599 26.8999 62.8199 34.9999 51.8399 34.9999C40.8599 34.9999 35.6599 27.2899 35.6599 17.5699C35.6599 7.84994 41.7899 0.189941 52.2799 0.189941C62.1799 0.189941 68.4599 7.10994 68.4599 17.4699ZM43.2099 17.4199C43.2099 24.0499 46.0999 29.0599 52.0799 29.0599C58.5999 29.0599 60.8999 23.6099 60.8999 17.5699C60.8999 11.1399 58.2499 6.12994 51.9799 6.12994C45.7099 6.12994 43.1999 10.8399 43.1999 17.4199H43.2099Z"
                        fill="white" />
                    <path
                        d="M137.24 24.0499C135.92 30.3799 131.16 34.9999 122.68 34.9999C111.94 34.9999 106.89 27.3899 106.89 17.7699C106.89 8.14994 112.14 0.189941 123.02 0.189941C132.04 0.189941 136.4 5.43994 137.24 11.1399H129.94C129.2 8.48994 127.39 5.88994 122.78 5.88994C116.75 5.88994 114.45 11.3399 114.45 17.5299C114.45 23.2299 116.46 29.2599 122.98 29.2599C127.78 29.2599 129.25 26.0699 129.89 24.0599H137.24V24.0499Z"
                        fill="white" />
                    <path
                        d="M143.46 0.679932H150.76V13.8399H164.39V0.679932H171.69V34.5099H164.39V19.8799H150.76V34.5099H143.46V0.679932Z"
                        fill="white" />
                    <path d="M186.5 6.66993H176.21V0.679932H204.06V6.66993H193.81V34.5099H186.51V6.66993H186.5Z"
                        fill="white" />
                    <path
                        d="M231.85 19.9299H215.67V28.5199H233.51L232.63 34.5099H208.56V0.679932H232.53V6.66993H215.67V13.8899H231.85V19.9299Z"
                        fill="white" />
                    <path
                        d="M267.54 24.0499C266.22 30.3799 261.46 34.9999 252.98 34.9999C242.24 34.9999 237.19 27.3899 237.19 17.7699C237.19 8.14994 242.44 0.189941 253.32 0.189941C262.34 0.189941 266.7 5.43994 267.54 11.1399H260.24C259.5 8.48994 257.69 5.88994 253.08 5.88994C247.05 5.88994 244.75 11.3399 244.75 17.5299C244.75 23.2299 246.76 29.2599 253.28 29.2599C258.08 29.2599 259.55 26.0699 260.19 24.0599H267.54V24.0499Z"
                        fill="white" />
                    <path
                        d="M273.76 0.679932H281.06V13.8399H294.69V0.679932H301.99V34.5099H294.69V19.8799H281.06V34.5099H273.76V0.679932Z"
                        fill="white" />
                    <path
                        d="M91.9901 0.679932H82.8201L71.3501 34.5099H78.5601C80.4701 28.3699 86.3101 9.26993 87.1401 5.92993H87.1901C88.0201 8.96993 93.9101 27.3399 96.3101 34.5099H104.01L91.9901 0.679932Z"
                        fill="white" />
                </svg>


                {{-- <span class="ml-3 text-xl">COACHETCH</span> --}}
            </a>
            {{-- <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <a class="mr-5 hover:text-gray-900">First Link</a>
                <a class="mr-5 hover:text-gray-900">Second Link</a>
                <a class="mr-5 hover:text-gray-900">Third Link</a>
                <a class="mr-5 hover:text-gray-900">Fourth Link</a>
            </nav> --}}
            {{-- <button
                class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Button
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </button> --}}
        </div>
    </header>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            {{-- <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a> --}}
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
