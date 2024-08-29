@props(['fontSize' => '4xl'])

<div class="text-{{ $fontSize }} font-bold text-center">
    <a href="{{ route('home') }}" class="dark:text-slate-100 hover:text-sky-400">{{ config('app.name', 'Laravel') }}</a>
    <span class="text-sky-500">Blog</span>
</div>
