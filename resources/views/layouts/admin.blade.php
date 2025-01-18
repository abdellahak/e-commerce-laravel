<!DOCTYPE html>
<html lang="en" class="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
  <title>@yield('title')</title>
  <script>
    // Check if dark mode is enabled from localStorage
    const storedTheme = localStorage.getItem('theme');
    if (storedTheme) {
      document.documentElement.classList.toggle('dark', storedTheme === 'dark');
    }
    // Function to toggle dark mode
    function toggleDarkMode() {
      const isDarkMode = document.documentElement.classList.toggle('dark');
      // Save the theme in localStorage
      localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
    }
  </script>
</head>

<body class="bg-slate-900 text-white dark:bg-white dark:text-black relative min-h-screen">
  <div class="flex min-h-screen">
    <div
      class="container hidden md:block w-fit min-w-52 bg-slate-800 text-white dark:bg-gray-200 dark:text-black min-h-full">
      <div class="fixed w-5 min-w-52 h-full">

        <div class="flex flex-col h-full justify-between">
          <div>
            <h1 class="text-3xl my-2 p-4">Abde Store</h1>
            <ul class="flex flex-col">
              <li class="my-1">
                <a href="{{ route('clients.index') }}"
                  @if (View::getSection('page') == 'clients') class="w-full bg-slate-700 dark:bg-gray-300 block p-3 text-md border-r-4 border-r-blue-600"
                  @else
                  class="w-full hover:bg-slate-700 dark:hover:bg-gray-300 block p-3 text-md" @endif><i
                    class="fa-regular fa-user mx-2"></i>Clients</a>
              </li>
              <li class="my-1">
                <a href="{{ route('categories.index') }}"
                  @if (View::getSection('page') == 'categories') class="w-full bg-slate-700 dark:bg-gray-300 block p-3 text-md border-r-4 border-r-blue-600"
                  @else
                  class="w-full hover:bg-slate-700 dark:hover:bg-gray-300 block p-3 text-md" @endif><i
                    class="fa-solid fa-code-fork mx-2"></i>Categories</a>
              </li>
              <li class="my-1">
                <a href="{{ route('products.index') }}"
                  @if (View::getSection('page') == 'products') class="w-full bg-slate-700 dark:bg-gray-300 block p-3 text-md border-r-4 border-r-blue-600"
                @else
                class="w-full hover:bg-slate-700 dark:hover:bg-gray-300 block p-3 text-md" @endif><i
                    class="fa-solid fa-store mx-2"></i>Products</a>
              </li>
              <li class="my-1">
                <a href="{{ route('commands.index') }}"
                  @if (View::getSection('page') == 'commands') class="w-full bg-slate-700 dark:bg-gray-300 block p-3 text-md border-r-4 border-r-blue-600"
                @else
                class="w-full hover:bg-slate-700 dark:hover:bg-gray-300 block p-3 text-md" @endif><i
                    class="fa-solid fa-cart-shopping mx-2"></i>Commands</a>
              </li>
            </ul>
          </div>
            <a href="https://github.com/abdellahak" target="_blank" class="flex items-center p-2 gap-2 pb-5 hover:bg-slate-700 dark:hover:bg-gray-300">
            <img src="{{ url('/storage/admin/images/my picture.png') }}" alt="" class="h-10 w-10 rounded-full">
            <p>Abdellah Khouden</p>
            </a>
        </div>
      </div>
    </div>
    @yield('content')
  </div>
  <script>
    // delete code :
  </script>
</body>

</html>
