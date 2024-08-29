<x-guest-layout>

    {{-- breadcrumb --}}
    <x-breadcrumb :title="$post->title" />

    {{-- Blog Content --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>

        <!-- Categories Box -->
        <x-category-post :categories="$post->categories" />
        {{-- http://127.0.0.1:8000/posts/cumque-officiis-ab-asperiores-magnam-perferendis --}}
        <span class="disqus-comment-count" data-disqus-url="{{ route('posts.show', $post->slug) }}"></span>
        {{-- <span class="disqus-comment-count" data-disqus-identifier="article_1_identifier"></span> --}}
        @if ($post->getFirstMedia())
            <img src="{{ URL::to('/media') }}/{{ $post->getFirstMedia()->id }}/{{ $post->getFirstMedia()->file_name }}"
                alt="{{ $post->title }}" class="md:h-96 rounded-md mt-4 mb-4">
        @else
            <img src="{{ asset('storage/image/no-picture-available.jpg') }}" alt="{{ $post->title }}"
                class="md:h-96 rounded-md mt-4 mb-4">
        @endif
        <p>{!! $post->body !!}</p>
    </div>


    {{-- Comment Discuss --}}
    <div id="disqus_thread"></div>
    <script>
        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
        /*
        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document,
                s = d.createElement('script');
            s.src = 'https://laravel-blog-kcpcsxsmxj.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <script id="dsq-count-scr" src="//laravel-blog-kcpcsxsmxj.disqus.com/count.js" async></script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
            Disqus.</a>
    </noscript>

    {{-- Other Blog --}}
    <div class="mt-8">
        <h2 class="text-2xl font-bold mb-4">Other Blog</h2>

        <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mb-4">
            @forelse ($posts as $post)
                <x-post-card :post="$post" />
            @empty
                
            @endforelse
        </div>
    </div>
</x-guest-layout>
