@props(['categories'])


@forelse ($categories as $category)
    @php
        $colorMap = [
            'red' => 'bg-red-600',
            'green' => 'bg-green-600',
            'cyan' => 'bg-cyan-600',
            'purple' => 'bg-purple-600',
            'yellow' => 'bg-yellow-600',
            'blue' => 'bg-blue-600',
            'gray' => 'bg-gray-600',
        ];

        $colors = $colorMap[$category->color] ?? 'bg-gray-500';
    @endphp

    <a href="{{ route('category.public.show', $category->slug) }}"
        {{ $attributes->merge(['class' => 'inline-block ' . $colors . ' text-white text-xs font-medium px-3 py-1 rounded-full mr-1 hover:scale-105 hover:shadow-md']) }}>
        {{ $category->name }}
    </a>
@empty
@endforelse