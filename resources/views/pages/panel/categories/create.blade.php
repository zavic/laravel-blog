<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
                Create a New Category
            </h2>
        </div>
    </x-slot>

    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-2 mt-4">
            <label for="name" class="block text-sm font-medium leading-6 text-gray-700 dark:text-gray-200">
                Category Name
            </label>
            <div class="rounded-md shadow-sm">
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="block w-full rounded-md border-0 py-1.5 focus:ring-2 focus:ring-inset focus:ring-sky-700 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            @if ($errors->has('name'))
                <span class="text-sm text-red-600">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="mb-2">
            <label for="color"
                class="block text-sm font-medium leading-6 text-gray-700 dark:text-gray-200">Color</label>
            <select id="color" name="color" 
                class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-md shadow-sm leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Choose Color</option>
                <option value="red">Red</option>
                <option value="green">Green</option>
                <option value="cyan">Cyan</option>
                <option value="purple">Purple</option>
                <option value="blue">Blue</option>
                <option value="yellow">Yellow</option>

            </select>
            @if ($errors->has('color'))
                <span class="text-sm text-red-600">{{ $errors->first('color') }}</span>
            @endif
        </div>

        <x-primary-button>
            Create
        </x-primary-button>

    </form>

</x-app-layout>
