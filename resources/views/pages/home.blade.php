<x-guest-layout>

    <section class="relative pt-20 pb-12 overflow-hidden sm:pb-16 sm:pt-32 lg:pb-24 xl:pb-32 xl:pt-40">
        <div class="relative z-10">
            <div
                class="absolute inset-x-0 top-1/2 -z-10 flex -translate-y-1/2 justify-center overflow-hidden [mask-image:radial-gradient(50%_45%_at_50%_55%,white,transparent)]">
                <svg class="h-[60rem] w-[100rem] flex-none stroke-blue-600 opacity-20" aria-hidden="true">
                    <defs>
                        <pattern id="e9033f3e-f665-41a6-84ef-756f6778e6fe" width="200" height="200" x="50%" y="50%"
                            patternUnits="userSpaceOnUse" patternTransform="translate(-100 0)">
                            <path d="M.5 200V.5H200" fill="none"></path>
                        </pattern>
                    </defs>

                    <rect width="100%" height="100%" stroke-width="0"
                        fill="url(#e9033f3e-f665-41a6-84ef-756f6778e6fe)">
                    </rect>
                </svg>
            </div>
        </div>
        <div class="relative z-20 px-6 mx-auto max-w-7xl lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                    Sayyid Zavic
                    <span class="text-blue-600">Blog
                    </span>
                </h1>
                <h2 class="mt-6 text-lg leading-8 text-gray-600">
                  Articles with good SEO and fast loading performance.
                </h2>
                <div class="flex items-center justify-center mt-10 gap-x-6">
                    <a class="inline-flex items-center justify-center gap-2 px-4 py-3 text-sm font-semibold text-white transition-all duration-150 bg-blue-600 shadow-sm isomorphic-link isomorphic-link--internal rounded-xl hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                        href="{{ route('posts.public.index') }}">All Posts
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- All Post --}}
    <div id="all-posts" class="pt-8 mb-8">
        <h1 class="text-3xl font-bold mb-7">All Posts</h1>

        <div class="grid gap-6 mb-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse ($posts as $post)
                <x-post-card :post="$post" />
            @empty
                <p>No Posts yet</p>
            @endforelse
        </div>

        {{ $posts->links() }}
    </div>

    {{-- Post by Category --}}
    <div class="mb-4">
        @if ($categories->isNotEmpty())
            <h1 class="text-3xl font-bold">Posts by Category</h1>
        @endif
        @foreach ($categories as $category)
            <h2 class="mt-5 mb-3 text-2xl font-semibold">{{ $category->name }}</h2>
            <div class="grid gap-6 mb-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($category->posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>

            <div class="mt-5 mb-8">
                <x-read-more-button :link="route('category.public.show', $category->slug)">
                    See more {{ $category->name }} categories
                </x-read-more-button>
            </div>
        @endforeach
    </div>
</x-guest-layout>
