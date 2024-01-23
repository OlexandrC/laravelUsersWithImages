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
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://unpkg.com/urijs/src/URI.min.js"></script>

    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                <a href="{{ asset('/') }}" class="top-menu-padding">
                    <button>HOME</button>
                </a>
                <a href="{{ route('users.index') }}" class="top-menu-padding">
                    <button>USER LIST</button>
                </a>
                <a href="{{ route('users.create') }}" class="top-menu-padding">
                    <button>ADD USER IMAGE</button>
                </a>
            </div>

            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>
