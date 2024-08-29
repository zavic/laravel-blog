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

<body class="text-gray-900 bg-gray-100 dark:bg-gray-900 dark:text-gray-100">
    <!-- Header -->

    <header class="py-4 text-gray-100 bg-slate-800">
        <div class="container flex items-center justify-between px-4 mx-auto">
            <!-- Logo / Blog Title -->
            <div class="text-xl font-bold">
                <a href="{{ route('home') }}" class="hover:text-sky-400">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <span class="text-sky-500">Blog</span>
            </div>

            <!-- Hamburger Icon for Mobile -->
            <div class="flex items-center lg:hidden">
                <button id="menu-button" class="text-gray-100 hover:text-sky-400 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Navigation Menu -->
            <nav id="menu" class="hidden lg:flex lg:items-center">
                <ul class="flex space-x-2">
                    <li>
                        <a href="#" class="px-4 py-2 rounded-md hover:bg-gray-600">Project</a>
                    </li>
                    <li>
                        @if (request()->is('posts*') || request()->is('/'))
                            <a href="{{ route('posts.public.index') }}" class="px-4 py-2 rounded-md bg-sky-600">
                                Blog
                            </a>
                        @else
                            <a href="{{ route('posts.public.index') }}"
                                class="px-4 py-2 rounded-md hover:bg-gray-600">Blog</a>
                        @endif
                    </li>
                    <li>
                        <a href="#" class="px-4 py-2 rounded-md hover:bg-gray-600">Contact</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="fixed inset-0 z-50 hidden bg-gray-800 lg:hidden bg-opacity-95">
            <div class="flex flex-col items-center py-8 space-y-4">
                <!-- Close Button -->
                <button id="close-menu-button" class="absolute text-gray-100 top-4 right-4 hover:text-sky-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <!-- Menu Links -->
                <a href="#" class="px-4 py-2 text-gray-100 rounded-md hover:bg-gray-600">Project</a>
                <a href="{{ route('posts.index') }}"
                    class="px-4 py-2 text-gray-100 rounded-md hover:bg-gray-600">Blog</a>
                <a href="{{ route('about') }}" class="px-4 py-2 text-gray-100 rounded-md hover:bg-gray-600">About</a>
                <a href="{{ route('contact') }}"
                    class="px-4 py-2 text-gray-100 rounded-md hover:bg-gray-600">Contact</a>
            </div>
        </div>
    </header>


    <!-- Main Content -->
    <main class="container px-4 py-8 mx-auto">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="py-4 bg-gray-200 dark:bg-gray-800 dark:text-gray-100">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Sayyid Zavic. All rights reserved.</p>
        </div>
    </footer>

    <!-- Script to Toggle Header menu -->
    <script>
        document.getElementById('menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        document.getElementById('close-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.add('hidden');
        });
    </script>

</body>

</html>
