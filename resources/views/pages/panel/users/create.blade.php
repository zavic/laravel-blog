<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
                Create a New User
            </h2>
        </div>
    </x-slot>

    <form action="{{ route('users.store') }}" method="post">
        @csrf

        <div class="mb-2 mt-4">
            <label for="name" class="block text-sm font-medium leading-6 text-gray-700 dark:text-gray-200">
                Name
            </label>
            <div class="rounded-md shadow-sm">
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="block w-full rounded-md border-0 py-1.5 focus:ring-2 focus:ring-inset focus:ring-sky-700 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            @if ($errors->has('name'))
                <span class="text-sm text-red-600">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="mb-2 mt-4">
            <label for="email" class="block text-sm font-medium leading-6 text-gray-700 dark:text-gray-200">
                Email
            </label>
            <div class="rounded-md shadow-sm">
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="block w-full rounded-md border-0 py-1.5 focus:ring-2 focus:ring-inset focus:ring-sky-700 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            @if ($errors->has('email'))
                <span class="text-sm text-red-600">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="mb-2">
            <label for="role"
                class="block text-sm font-medium leading-6 text-gray-700 dark:text-gray-200">Role</label>
            <select id="role" name="role"
                class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-md shadow-sm leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Choose Role</option>
                <option {{ old('role') == 'USER' ? 'selected' : '' }} value="USER">User</option>
                <option {{ old('role') == 'EDITOR' ? 'selected' : '' }} value="EDITOR">Editor</option>
                <option {{ old('role') == 'ADMIN' ? 'selected' : '' }} value="ADMIN">Admin</option>
            </select>
            @if ($errors->has('role'))
                <span class="text-sm text-red-600">{{ $errors->first('role') }}</span>
            @endif
        </div>

        <div class="mb-2 mt-4">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-700 dark:text-gray-200">
                Password
            </label>
            <div class="rounded-md shadow-sm">
                <input type="password" name="password" id="password"
                    class="block w-full rounded-md border-0 py-1.5 focus:ring-2 focus:ring-inset focus:ring-sky-700 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            @if ($errors->has('password'))
                <span class="text-sm text-red-600">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="mb-2 mt-4">
            <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-700 dark:text-gray-200">
                Confirm Password
            </label>
            <div class="rounded-md shadow-sm">
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="block w-full rounded-md border-0 py-1.5 focus:ring-2 focus:ring-inset focus:ring-sky-700 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
        </div>

        <x-primary-button>
            Create
        </x-primary-button>

    </form>

</x-app-layout>
