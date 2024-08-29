<!-- resources/views/components/breadcrumb.blade.php -->

@php
    $route = \Request::route()->getName();
@endphp

<nav class="text-xs md:text-sm text-gray-500 dark:text-slate-300 mb-2">
    <ol class="list-reset flex">
        <li class="hover:text-sky-600">
            <div class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4 md:size-5 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <a href="{{ route('home') }}">Home</a>
            </div>
        </li>
        <li>
            <span class="mx-2">/</span>
        </li>
        @if (str_starts_with($route, 'posts'))
            <li class="hover:text-sky-600">
                <a href="{{ route('posts.public.index') }}">Blog</a>
            </li>
        @endif
        @if ($route === 'category.show')
            <li class="hover:text-sky-600">
                <a href="{{ route('posts.public.index') }}">Blog</a>
            </li>
            <li>
                <span class="mx-2">/</span>
            </li>
            <li>
                <span>Category</span>
            </li>
            <li>
                <span class="mx-2">/</span>
            </li>
            <li>{{ $title }}</li>
        @endif

        @if ($route === 'about')
            <li>
                <a href="{{ route('about') }}">About</a>
            </li>
        @endif
        @if ($route === 'contact')
            <li>
                <a href="{{ route('contact') }}">Contact</a>
            </li>
        @endif
        @if ($route === 'posts.show')
            <li>
                <span class="mx-2">/</span>
            </li>
            <li>{{ $title }}</li>
        @endif
    </ol>
</nav>
