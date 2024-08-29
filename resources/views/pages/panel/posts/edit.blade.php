<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
                {{ $post->title }}
            </h2>
        </div>
    </x-slot>

    <form action="{{ route('posts.update', $post->id) }}" method="post">
        @csrf
        @method('PUT')
        <div id="new-post" class="flex flex-col md:flex-row gap-6 mt-2 mb-12">
            <div class="flex-1 md:w-2/3">

                {{-- Title --}}
                <x-text-input class="w-full" name="title" value="{{ $post->title }}" placeholder="Enter Title Here" />

                {{-- Body --}}
                <div class="mt-6">
                    <textarea id="mytextarea" name="body">{{ $post->body }}</textarea>
                </div>

            </div>

            <div class="flex flex-col gap-6 md:w-1/3">

                {{-- Category --}}
                <div class="p-4 bg-white shadow-sm rounded-lg dark:bg-slate-800 dark:text-slate-200">
                    <h4 class="text-lg font-semibold">Category</h4>
                    <hr class="mb-1">

                    <div class="mb-4">
                        <label for="category-search" class="block text-gray-700 text-sm font-bold mb-2">Search or Create
                            Category:</label>
                        <input type="text" id="category-search"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Search or create a category...">
                        <div id="category-options"
                            class="mt-2 max-h-40 border border-gray-200 overflow-y-auto bg-white shadow-lg rounded hidden">

                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Selected Categories:</label>
                        <div id="selected-categories" class="flex flex-wrap gap-2 rounded"></div>
                    </div>

                    <input type="hidden" name="categories" id="categories-input">
                </div>

                {{-- Publish --}}
                <div class="p-4 bg-white shadow-sm rounded-lg dark:bg-slate-800 dark:text-slate-200 md:order-first">
                    <h4 class="text-lg font-semibold">Publish</h4>



                    <hr class="mb-1">

                    <div x-data="{ showMenu: false, visibility: 'public' }">
                        <p>
                            Status:
                            @if ($post->published_at === null)
                                <span class="text-yellow-600 font-bold">Draft</span>
                            @elseif ($post->published_at > now())
                                <span class="text-sky-600 font-bold">Scheduled</span>
                            @else
                                <span class="text-green-600 font-bold">Published</span>
                            @endif

                        </p>
                    </div>

                    <div x-data="{ visibility: '{{ $post->visibility }}', showMenu: false }" class="mb-4">
                        <div class="flex items-center">
                            <p>Visibility: </p>
                            <p id="visibility-text" class="font-bold ml-1"
                                x-text="visibility.charAt(0).toUpperCase() + visibility.slice(1)">
                                {{ $post->visibility }}
                            </p>
                            <button type="button" x-on:click="showMenu = !showMenu"
                                class="text-sky-700 hover:text-sky-500 ml-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </button>
                        </div>

                        <input type="hidden" name="visibility" x-model="visibility">

                        <div x-show="showMenu" x-on:click.away="showMenu = false" class="relative">
                            <div class="absolute mt-2 w-40 bg-white border rounded shadow-md z-10">
                                <ul>
                                    <li x-on:click="visibility = 'public'; showMenu = false"
                                        class="p-2 hover:bg-blue-100 cursor-pointer">Public</li>
                                    <li x-on:click="visibility = 'private'; showMenu = false"
                                        class="p-2 hover:bg-blue-100 cursor-pointer">Private</li>
                                    <li x-on:click="visibility = 'unlisted'; showMenu = false"
                                        class="p-2 hover:bg-blue-100 cursor-pointer">Unlisted</li>
                                </ul>
                            </div>
                        </div>
                    </div>



                    @if ($post->published_at > now() || $post->published_at === null)
                        <label for="schedule-checkbox" class="inline-flex items-center mb-1">
                            <input id="schedule-checkbox" type="checkbox"
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-sky-600 shadow-sm focus:ring-sky-500 dark:focus:ring-sky-600 dark:focus:ring-offset-gray-800"
                                name="is_checked" @if ($post->published_at > now()) checked @endif>
                            <span class="ms-2 dark:text-gray-400">Schedule</span>
                        </label>
                        <div>
                            <x-text-input id="schedule-input" name="published_at" min="{{ now()->format('Y-m-d\TH:i') }}"
                                class="mb-2 @if ($post->published_at === null) hidden @endif" type="datetime-local" 
                                value="{{ $post->published_at === null ? '' : $post->published_at }}" />
                        </div>
                    @endif

                    <!-- Save Button -->
                    <x-primary-button class="mb-2 mt-4">
                        Save changes
                    </x-primary-button>

                    @if ($post->published_at > now() || $post->published_at === null)
                        <span class="mx-3" id="or-text">or</span>

                        <!-- Publish Now Button -->
                        <x-primary-button id="publish-now-button" class="mb-2 mt-4 bg-blue-700 hover:bg-blue-800"
                            name="action" value="publish_now">
                            Publish Now
                        </x-primary-button>
                    @endif

                </div>

            </div>
        </div>

    </form>

    @push('tinymce')
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
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
            });
        </script>
    @endpush

    @push('script')
        {{-- Schedule Form --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const checkbox = document.getElementById('schedule-checkbox');
                const input = document.getElementById('schedule-input');

                const orText = document.getElementById('or-text');
                const draftButton = document.getElementById('draft-button');

                checkbox.addEventListener('change', function() {
                    if (checkbox.checked) {
                        input.classList.remove('hidden');
                        draftButton.classList.add('hidden');
                        orText.classList.add('hidden');
                    } else {
                        input.classList.add('hidden');
                        draftButton.classList.remove('hidden');
                        orText.classList.remove('hidden');
                    }
                });
            });
        </script>

        {{-- Category Form --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const categorySearchInput = document.getElementById('category-search');
                const optionsDiv = document.getElementById('category-options');
                const selectedCategoriesDiv = document.getElementById('selected-categories');
                const categoriesInput = document.getElementById('categories-input');

                const selectedCategories = @json($selectedCategories);

                // Load existing categories
                selectedCategories.forEach(category => {
                    addCategoryToSelection(category.id, category.name, category.isNew);
                });

                // Handle category search input
                categorySearchInput.addEventListener('input', function() {
                    const query = this.value.trim();
                    optionsDiv.innerHTML = '';

                    if (query.length > 0) {
                        fetch(`/panel/categories/search?query=${query}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.length > 0) {
                                    data.forEach(category => {
                                        createOption(category.id, category.name);
                                    });
                                } else {
                                    createNewCategoryOption(query);
                                }
                                optionsDiv.classList.remove('hidden');
                            });
                    }
                });

                function createOption(id, name) {
                    const optionDiv = document.createElement('div');
                    optionDiv.className = "p-2 cursor-pointer hover:bg-blue-100";
                    optionDiv.setAttribute('type', 'button');
                    optionDiv.textContent = name;
                    optionDiv.addEventListener('click', function() {
                        addCategoryToSelection(id, name);
                        optionsDiv.classList.add('hidden');
                    });
                    optionsDiv.appendChild(optionDiv);
                }

                function createNewCategoryOption(query) {
                    const createNewDiv = document.createElement('div');
                    createNewDiv.id = 'create-new-category';
                    createNewDiv.className = "p-2 cursor-pointer text-green-500 hover:bg-green-100";
                    createNewDiv.setAttribute('type', 'button');
                    createNewDiv.textContent = `Create new category: "${query}"`;
                    createNewDiv.addEventListener('click', function() {
                        addCategoryToSelection(query, query, true);
                        optionsDiv.classList.add('hidden');
                    });

                    // Ensure no duplicate "Create new category" option
                    const existingNewCategoryDiv = document.getElementById('create-new-category');
                    if (existingNewCategoryDiv) {
                        existingNewCategoryDiv.remove();
                    }
                    optionsDiv.appendChild(createNewDiv);
                }

                function addCategoryToSelection(id, name, isNew = false) {
                    // Check if category is already added
                    const categoriesArray = categoriesInput.value ? JSON.parse(categoriesInput.value) : [];
                    if (!categoriesArray.some(category => category.name === name)) {
                        const categorySpan = document.createElement('span');
                        categorySpan.className =
                            "inline-block bg-blue-200 text-blue-800 text-sm px-3 py-1 rounded-full";
                        categorySpan.textContent = name;

                        const removeIcon = document.createElement('span');
                        removeIcon.className = "ml-2 cursor-pointer text-red-500";
                        removeIcon.textContent = "x";
                        removeIcon.onclick = function() {
                            selectedCategoriesDiv.removeChild(categorySpan);
                            categoriesInput.value = JSON.stringify(
                                categoriesArray.filter(category => category.name !== name)
                            );
                        };

                        categorySpan.appendChild(removeIcon);
                        selectedCategoriesDiv.appendChild(categorySpan);

                        categoriesArray.push({
                            id,
                            name,
                            isNew
                        });
                        categoriesInput.value = JSON.stringify(categoriesArray);
                    }
                }
            });
        </script>
    @endpush

</x-app-layout>
