<button {{ $attributes->merge(['type' => 'submit', 'class' => 'tracking-widest px-4 py-2 font-semibold text-sm text-white bg-sky-500 rounded-lg shadow-sm hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-opacity-75 active:bg-sky-700 transition ease-in-out duration-150 dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-500 dark:active:bg-sky-800']) }}>
    {{ $slot }}
</button>
