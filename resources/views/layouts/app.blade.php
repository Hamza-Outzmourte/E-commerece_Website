<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white">

    <!-- Navbar -->
    <header class="bg-white dark:bg-gray-800 shadow fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">

            <!-- Logo agrandi -->
            <div class="flex items-center space-x-2">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/2.png') }}" alt="Logo" class="h-22 w-auto"> <!-- h-14 = logo plus grand -->
                </a>
            </div>

            <!-- Barre de recherche réduite -->
            <div class="mx-4">
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <input type="text" name="query" placeholder="Rechercher..."
                        class="w-64 md:w-80 py-2 px-4 rounded-md border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <button type="submit"
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300">
                        🔍
                    </button>
                </form>
            </div>

            <!-- Actions utilisateur -->
            <div class="flex items-center space-x-4">
                <!-- Panier -->
                <a href="{{ route('cart.index') }}" class="relative text-gray-700 dark:text-gray-300 hover:text-blue-600 text-xl">
                    🛒
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full text-xs px-1">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>

                @auth
                    <span class="text-sm text-gray-700 dark:text-gray-300">
                        Bonjour, {{ Auth::user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">
                            Déconnexion
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-sm">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                        Inscription
                    </a>
                @endguest
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="flex pt-16 h-screen">
        <main class="flex-1 p-6 overflow-y-auto bg-gray-100 dark:bg-gray-900">
            @if (View::hasSection('header'))
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg mb-6 px-6 py-4">
                    @yield('header')
                </div>
            @endif

            <!-- <div class="bg-white dark:bg-gray-800 shadow rounded-lg px-6 py-6"> -->
                @yield('content')
            <!-- </div> -->
        </main>
    </div>
    <!-- Footer container -->

<script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
