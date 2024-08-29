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
    
    @stack('head')
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>

<body class="bg-gray-100 dark:bg-gray-950">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div id="sidebar"
            class="absolute inset-y-0 left-0 z-50 flex flex-col p-6 space-y-6 text-white transition-all duration-300 ease-in-out transform -translate-x-full w-52 bg-slate-900 lg:relative lg:translate-x-0">

            <div class="relative flex">
                <x-application-logo fontSize="lg" />
                <button id="sidebar-button"
                    class="absolute top-0 text-slate-800 me-3 focus:outline-none lg:hidden -right-20">

                    <div id="close-sidebar-icon" class="hidden p-1 rounded-full text-slate-100 bg-slate-800">
                        <svg class="w-6 h-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </div>
                    <svg id="open-sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-slate-200">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>

                </button>
            </div>

            <nav class="flex-1">
                <a href="{{ route('dashboard') }}"
                    class="block py-2 px-3 mb-2 rounded-md hover:bg-gray-700 @if (request()->is('panel')) bg-sky-700 @endif">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="ms-2">Dashboard</span>
                    </div>
                </a>
                <div class="block px-3 py-2 mb-2 rounded-md bg-slate-900 hover:bg-gray-700">
                    <div id="navbar-dropdown" class="flex items-center justify-between cursor-pointer">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>

                            <span class="ms-2">Posts</span>
                        </div>
                        <div id="icon-navbar-dropdown" class="ms-2">
                            <svg id="chevron-up" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="hidden size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                            <svg id="chevron-down" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>

                    <div id="list-navbar-dropdown" class="mt-2 @if (request()->is('dashboard/company*')) @else hidden @endif">
                        <a href="{{ route('posts.index') }}">
                            <div
                                class="px-3 py-1 rounded-md hover:bg-sky-700 @if (request()->is('dashboard/company')) bg-sky-700 @endif">
                                All Posts
                            </div>
                        </a>
                        <a href="{{ route('posts.create') }}">
                            <div
                                class="px-3 py-1 rounded-md hover:bg-sky-700 @if (request()->is('dashboard/company/create')) bg-sky-700 @endif">
                                Add New Post
                            </div>
                        </a>
                        <a href="{{ route('categories.index') }}">
                            <div
                                class="px-3 py-1 rounded-md hover:bg-sky-700 @if (request()->is('dashboard/company/create')) bg-sky-700 @endif">
                                Categories
                            </div>
                        </a>
                    </div>
                </div>
                <a href="https://disqus.com/admin/" target="_blank"
                    class="block py-2 px-3 mb-2 rounded-md hover:bg-gray-700 @if (request()->is('dashboard/business-type')) bg-sky-700 @endif">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                        </svg>

                        <span class="ms-2">Comment</span>
                    </div>
                </a>
                <a href="{{ route('users.index') }}"
                    class="block py-2 px-3 mb-2 rounded-md hover:bg-gray-700 @if (request()->is('dashboard/membership-type')) bg-sky-700 @endif">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>

                        <span class="ms-2">Users</span>
                    </div>
                </a>
                <a href="{{ route('profile.edit') }}"
                    class="block py-2 px-3 mb-2 rounded-md hover:bg-gray-700 @if (request()->is('dashboard/city')) bg-sky-700 @endif">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span class="ms-2">Settings</span>
                    </div>
                </a>
                <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="block py-2 px-3 mb-2 rounded-md hover:bg-gray-700 @if (request()->is('dashboard/city')) bg-sky-700 @endif">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                        <span class="ms-2">Logout</span>
                    </div>
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
            </nav>
        </div>

        <div class="flex-1">
            <!-- Header -->
            <div class="flex items-center justify-center px-6 py-4 text-white">
                <div class="flex-1"></div>

                <!-- Settings Dropdown -->
                <div class="flex sm:items-center sm:ms-6">
                    <x-dropdown width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>


                </div>
            </div>

            <!-- Alert Success -->
            @session('success')
                <div id="alert" class="flex p-4 mx-6 mb-3 text-green-900 bg-green-200 shadow-sm rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="flex-1 ms-2">{{ session('success') }}</span>
                    <svg id="close-button-alert" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="cursor-pointer size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>
                <script>
                    const alert = document.getElementById('alert');
                    const closeButtonAlert = document.getElementById('close-button-alert');

                    // Automatically close after 6 seconds
                    setTimeout(() => {
                        alert.classList.add('hidden');
                    }, 6000);

                    // Close on click of close icon
                    closeButtonAlert.addEventListener('click', () => {
                        alert.classList.add('hidden');
                    });
                </script>
            @endsession

            <!-- Alert Failed -->
            @session('failed')
                <div id="alert" class="flex p-4 mx-6 mb-3 text-red-900 bg-red-200 shadow-sm rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <span class="flex-1 ms-2">{{ session('failed') }}</span>
                    <svg id="close-button-alert" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="cursor-pointer size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>
                <script>
                    const alert = document.getElementById('alert');
                    const closeButtonAlert = document.getElementById('close-button-alert');

                    // Automatically close after 6 seconds
                    setTimeout(() => {
                        alert.classList.add('hidden');
                    }, 6000);

                    // Close on click of close icon
                    closeButtonAlert.addEventListener('click', () => {
                        alert.classList.add('hidden');
                    });
                </script>
            @endsession


            <!-- Page Heading -->
            @isset($header)
                <header class="px-2 sm:px-0">
                    <div class="px-4 max-w-7xl sm:px-6 lg:px-6">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Main content -->
            <div class="px-6">
                {{ $slot }}
            </div>

        </div>
    </div>

    {{-- Sidebar --}}
    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarButton = document.getElementById('sidebar-button');
        const openSidebarIcon = document.getElementById('open-sidebar-icon');
        const closeSidebarIcon = document.getElementById('close-sidebar-icon');

        sidebarButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            openSidebarIcon.classList.toggle('hidden');
            closeSidebarIcon.classList.toggle('hidden');
        });
    </script>

    {{-- Navbar --}}
    <script>
        const navbarDropdown = document.getElementById('navbar-dropdown');
        const listNavbarDropdown = document.getElementById('list-navbar-dropdown');

        const chevronUp = document.getElementById('chevron-up');
        const chevronDown = document.getElementById('chevron-down');

        navbarDropdown.addEventListener('click', () => {
            listNavbarDropdown.classList.toggle('hidden');

            if (chevronUp.classList.contains('hidden')) {
                chevronUp.classList.remove('hidden');
                chevronDown.classList.add('hidden');
            } else {
                chevronUp.classList.add('hidden');
                chevronDown.classList.remove('hidden');
            }
        });
    </script>

    @stack('script')
</body>

</html>
