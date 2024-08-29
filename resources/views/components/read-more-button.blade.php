@props(['link'])


<a href="{{ $link }}"
    class="inline-flex items-center px-4 py-2 text-sm font-semibold text-slate-100 bg-sky-600 dark:bg-slate-700 hover:bg-sky-700 rounded-md">
    {{ $slot }}
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="w-4 h-4 ml-2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
</a>
