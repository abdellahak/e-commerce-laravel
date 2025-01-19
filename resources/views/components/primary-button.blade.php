<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 dark:bg-gray-800 bg-gray-200 border border-transparent rounded-md font-semibold text-xs dark:text-white text-gray-800 uppercase tracking-widest dark:hover:bg-gray-700 hover:bg-white dark:focus:bg-gray-700 focus:bg-white dark:active:bg-gray-900 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
