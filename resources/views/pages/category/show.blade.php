<x-guest-layout>

    <x-breadcrumb :title="$category->name" />

    {{-- All Post --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-7">{{ $category->name }}</h1>

        <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mb-4">
            @forelse ($posts as $post)
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <img src="https://via.placeholder.com/300" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <x-category-post :categories="$post->categories" />

                        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2 mt-1">{{ $post->title }}
                        </h2>

                        <p class="text-gray-600 dark:text-gray-400 mb-4 ">{{ Str::limit($post->body, 100) }}</p>
                        <a href="{{ route('posts.show', $post->slug) }}"
                            class="p-2 bg-sky-600 mt-4 text-slate-100 rounded-md hover:bg-gray-600">Read More</a>
                    </div>
                </div>
            @empty
                <p>No Posts yet</p>
            @endforelse
        </div>

        {{ $posts->links() }}
    </div>
</x-guest-layout>
