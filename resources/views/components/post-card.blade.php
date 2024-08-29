@props(['post'])
<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
    @if ($post->getFirstMedia())
        <img src="{{ URL::to('/media') }}/{{ $post->getFirstMedia()->id }}/conversions/{{ $post->getFirstMedia()->name }}-preview.jpg"
            alt="{{ $post->title }}" class="w-full h-48 object-cover">
    @else
        <img src="{{ asset('storage/image/no-picture-available.jpg') }}" alt="{{ $post->title }}"
            class="w-full h-48 object-cover">
    @endif
    <div class="p-4">
        <x-category-post :categories="$post->categories" />
        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">
            <a href="{{ route('posts.public.show', $post->slug) }}">
                {{ $post->title }}
            </a>
        </h2>
        <div class="text-gray-600 dark:text-gray-400 mb-4 ">{!! Str::limit($post->body, 100) !!}</div>

        <x-read-more-button :link="route('posts.public.show', $post->slug)">
            Read more
        </x-read-more-button>
    </div>
</div>
