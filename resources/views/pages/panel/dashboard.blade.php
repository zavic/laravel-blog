<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold leading-tight text-gray-800 dark:text-gray-200">
            Dashboard
        </h2>
    </x-slot>

    <div class="grid grid-cols-2 gap-4 mt-2 mb-8 sm:grid-cols-4 lg:grid-cols-6">
        <div class="p-4 bg-white rounded-lg shadow-sm dark:bg-slate-800">
            <div class="text-gray-900 dark:text-gray-200">
                All Posts
            </div>
            <div class="text-4xl font-bold text-gray-900 dark:text-gray-200">
                {{ $post }}
            </div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow-sm dark:bg-slate-800">
            <div class="text-gray-900 dark:text-gray-200">
                Published
            </div>
            <div class="text-4xl font-bold text-gray-900 dark:text-gray-200">
                {{ $published }}
            </div>
        </div>

        {{-- <div class="p-4 bg-white rounded-lg shadow-sm dark:bg-slate-800">
            <div class="text-gray-900 dark:text-gray-200">
                Comments
            </div>
            <div class="text-4xl font-bold text-gray-900 dark:text-gray-200">
                12
            </div>
        </div> --}}

        {{-- <div class="p-4 bg-white rounded-lg shadow-sm dark:bg-slate-800">
            <div class="text-gray-900 dark:text-gray-200">
                Tags
            </div>
            <div class="text-4xl font-bold text-gray-900 dark:text-gray-200">
                13
            </div>
        </div> --}}

        <div class="p-4 bg-white rounded-lg shadow-sm dark:bg-slate-800">
            <div class="text-gray-900 dark:text-gray-200">
                Visitor
            </div>
            <div class="text-4xl font-bold text-gray-900 dark:text-gray-200">
                {{ $visitor }}
            </div>
        </div>

        {{-- <div class="p-4 bg-white rounded-lg shadow-sm dark:bg-slate-800">
            <div class="text-gray-900 dark:text-gray-200">
                Likes
            </div>
            <div class="text-4xl font-bold text-gray-900 dark:text-gray-200">
                41
            </div>
        </div> --}}
    </div>


</x-app-layout>
