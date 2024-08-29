<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
                Categories
            </h2>
            <a href="{{ route('categories.create') }}"
                class="flex items-center pl-2 pr-3 py-1.5 ml-4 bg-sky-700 text-xs text-slate-100 rounded-md hover:scale-105 hover:bg-sky-800 hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add New
            </a>
        </div>
    </x-slot>

    <div class="shadow overflow-hidden rounded-lg mt-2 mb-10">
        <table class="min-w-full text-sm dark:text-gray-100">
            <thead class="bg-white text-xs uppercase font-medium dark:bg-gray-900">
                <tr>
                    <th></th>
                    <th scope="col" class="px-2 py-3 text-left">
                        Name
                    </th>
                    <th scope="col" class="px-2 py-3 text-left">
                        Slug
                    </th>
                    <th scope="col" class="px-2 py-3 text-left">
                        Color
                    </th>
                    <th scope="col" class="px-2 py-3 text-left">
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-slate-800">
                @forelse ($categories as $item)
                    <tr
                        class="{{ $loop->even ? 'dark:bg-black dark:bg-opacity-30' : 'bg-black bg-opacity-5 dark:bg-black dark:bg-opacity-10' }}">
                        <td class="pl-4 pr-2 py-4">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-2 py-4">
                            {{ $item->name }}
                        </td>
                        <td class="px-2 py-4">
                            {{ $item->slug }}
                        </td>
                        <td class="px-2 py-4">
                            {{ $item->color }}
                        </td>
                        <td class="py-4">
                            <div class="flex">
                                <a href="{{ route('categories.edit', $item->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="size-6 hover:text-blue-400 me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <form action="{{ route('categories.destroy', $item->id) }}" method="POST" 
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="size-6 hover:text-blue-400 me-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8">No Category yet</td>
                    </tr>
                @endforelse


            </tbody>
        </table>
    </div>


</x-app-layout>
