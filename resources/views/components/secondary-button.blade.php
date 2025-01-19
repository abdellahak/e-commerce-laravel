<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 dark:bg-white bg-gray-800 border dark:border-gray-300 border-gray-500 rounded-md font-semibold text-xs dark:text-gray-700 text-gray-300 uppercase tracking-widest shadow-sm dark:hover:bg-gray-50 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-offset-2 focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
