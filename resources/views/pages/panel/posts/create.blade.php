<x-app-layout>


    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-3xl font-bold leading-tight text-gray-800 dark:text-gray-200">
                Create a New Post
            </h2>
        </div>
    </x-slot>

    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div id="new-post" class="flex flex-col gap-6 mt-2 mb-12 md:flex-row">
            <div class="flex-1 md:w-2/3">

                <x-text-input class="w-full" name="title" :value="old('title')" placeholder="Enter Title Here" />
                <div class="mt-6">
                    <textarea name="body" id="mytextarea" cols="30" rows="10">{{ old('body') }}</textarea>
                </div>

            </div>

            <div class="flex flex-col gap-6 md:w-1/3">

                {{-- Category --}}
                <div class="p-4 bg-white rounded-lg shadow-sm dark:bg-slate-800 dark:text-slate-200">
                    <h4 class="text-lg font-semibold">Category</h4>
                    <hr class="mb-1">

                    <div class="mb-4">
                        <label for="category-search"
                            class="block mt-2 mb-1 text-sm font-bold text-gray-700 dark:text-gray-400">Search or Create
                            Category:
                        </label>

                        <select id="select_categories" class="w-full text-slate-800" name="categories[]"
                            multiple="multiple">
                            @forelse ($categories as $item)
                                <option value="{{ $item->id }}" >{{ $item->name }}</option>
                            @empty
                            @endforelse

                        </select>

                        <a href="{{ route('categories.create') }}"
                            class="text-sm underline text-cyan-600 hover:text-cyan-700 " target="_blank">
                            Add New Category
                        </a>
                        {{-- <x-text-input type="text" id="category-search" class="w-full"
                            placeholder="Search or create a category..." autocomplete="off" />
                        <div id="category-options"
                            class="hidden mt-2 overflow-y-auto bg-white border border-gray-200 rounded shadow-lg max-h-40">

                        </div> --}}
                    </div>

                    {{-- <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-400">Selected
                            Categories:</label>
                        <div id="selected-categories" class="flex flex-wrap gap-2 rounded"></div>
                    </div>

                    <input type="hidden" name="categories" id="categories-input"> --}}
                </div>

                {{-- Featured Image --}}
                <div x-data="{ showMediaManager: false, selectedImage: null }">
                    <div class="p-4 bg-white rounded-lg shadow-sm dark:bg-slate-800 dark:text-slate-200">
                        <h4 class="text-lg font-semibold">Featured Image</h4>

                        <hr class="mb-1">

                        <label class="block mt-4">
                            <span class="sr-only">Upload Image</span>
                            <input type="file" name="image" class="block w-full text-sm text-slate-500">
                        </label>
                    </div>
                </div>


                {{-- Publish --}}
                <div class="p-4 bg-white rounded-lg shadow-sm dark:bg-slate-800 dark:text-slate-200 md:order-first">
                    <h4 class="text-lg font-semibold">Publish</h4>

                    <hr class="mb-1">

                    <div x-data="{ showMenu: false, visibility: 'public' }" class="mb-4">
                        <p>
                            Status:
                            <span class="font-bold text-red-600">Not Saved</span>
                        </p>
                        <div class="flex items-center">
                            <p>Visibility: </p>

                            <p id="visibility-text" class="ml-1 font-bold"
                                x-text="visibility.charAt(0).toUpperCase() + visibility.slice(1)">
                                Public
                            </p>

                            <button type="button" x-on:click="showMenu = !showMenu"
                                class="ml-1 text-sky-700 hover:text-sky-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </button>
                        </div>

                        <input type="hidden" name="visibility" x-model="visibility">

                        <div x-show="showMenu" x-on:click.away="showMenu = false" class="relative">
                            <div class="absolute z-10 w-40 mt-2 bg-white border rounded shadow-md dark:bg-slate-700">
                                <ul>
                                    <li x-on:click="visibility = 'public'; showMenu = false"
                                        class="p-2 cursor-pointer hover:bg-blue-100 dark:text-slate-200 hover:dark:text-slate-700">
                                        Public</li>
                                    <li x-on:click="visibility = 'private'; showMenu = false"
                                        class="p-2 cursor-pointer hover:bg-blue-100 dark:text-slate-200 hover:dark:text-slate-700">
                                        Private</li>
                                    <li x-on:click="visibility = 'unlisted'; showMenu = false"
                                        class="p-2 cursor-pointer hover:bg-blue-100 dark:text-slate-200 hover:dark:text-slate-700">
                                        Unlisted</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <style>
                        input[type="date"] {
                            color-scheme: light dark;
                        }
                    </style>
                    <label for="schedule-checkbox" class="inline-flex items-center mb-1">
                        <input id="schedule-checkbox" type="checkbox"
                            class="border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 text-sky-600 focus:ring-sky-500 dark:focus:ring-sky-600 dark:focus:ring-offset-gray-800"
                            name="remember">
                        <span class="ms-2 dark:text-gray-400">Schedule</span>
                    </label>
                    <div>
                        <x-text-input id="schedule-input" name="published_at" class="hidden mb-2" type="date" />
                    </div>

                    <!-- Save as Draft Button -->
                    <x-primary-button id="draft-button" class="mt-4 mb-2 " name="action" value="draft">
                        Save as Draft
                    </x-primary-button>

                    <span class="mx-3" id="or-text">or</span>

                    <!-- Publish Now Button -->
                    <x-primary-button id="publish-now-button" class="mt-4 mb-2 bg-blue-700 hover:bg-blue-800"
                        name="action" value="publish_now">
                        Publish Now
                    </x-primary-button>

                    <!-- Schedule Post Button -->
                    <x-primary-button id="schedule-post-button" class="hidden mt-4 mb-2" name="action"
                        value="schedule_post">
                        Schedule Post
                    </x-primary-button>
                </div>

            </div>
        </div>

    </form>

    @push('head')
        <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
        <script type="text/javascript">
            tinymce.init({
                selector: '#mytextarea',
                license_key: 'gpl',
                height: 500,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
                skin: window.matchMedia("(prefers-color-scheme: dark)").matches ?
                    "oxide-dark" : "oxide",
                content_css: window.matchMedia("(prefers-color-scheme: dark)").matches ?
                    "dark" : "default",
            });
        </script>
    @endpush

    @push('script')
        <script>
            $(document).ready(function() {
                $('#select_categories').select2();
            });
        </script>
    @endpush



</x-app-layout>
