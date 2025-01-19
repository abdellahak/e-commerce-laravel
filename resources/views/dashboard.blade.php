<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl dark:text-gray-800 text-gray-200 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="dark:bg-white bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 dark:text-gray-900 text-gray-100">
          {{ __("You're logged in!") }}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
