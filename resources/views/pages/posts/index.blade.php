<x-guest-layout>

    {{-- breadcrumb --}}
    <x-breadcrumb />

    {{-- All Post --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-7">All Posts</h1>

        <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mb-4">
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
            <h2 class="text-2xl font-semibold mb-3 mt-5">{{ $category->name }}</h2>
            <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mb-4">
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
