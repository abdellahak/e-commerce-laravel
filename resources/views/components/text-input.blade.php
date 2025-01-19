@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'dark:border-gray-300 border-gray-700 dark:bg-white bg-gray-900 text-gray-300 dark:text-black dark:focus:border-indigo-500 focus:border-indigo-600 dark:focus:ring-indigo-500 focus:ring-indigo-600 rounded-md shadow-sm']) }}>
