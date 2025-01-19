<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
  <title>Moroccan amazon</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
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

<body class="bg-gray-900 dark:bg-slate-100 text-gray-100 dark:text-black saturate-130">
  <nav class="fixed top-0 left-0 right-0 bg-gray-800 dark:bg-gray-50 dark:text-black shadow-lg z-50 w-full ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        <a href="{{ route('home') }}">
          <h1 class="text-2xl font-bold">
            <i class="fa-solid fa-store mx-2"></i>
            Moroccan Amazon
          </h1>
        </a>
        <div class="flex items-center gap-4">
          <button onclick="showSearch()"
            class="dark:bg-gray-100 bg-gray-500 text-white dark:text-black rounded-full h-10 w-10 hover:bg-gray-700 dark:hover:bg-gray-300 block">
            <i class="fa-solid fa-search"></i>
          </button>
          <button onclick="toggleDarkMode()"
            class="dark:bg-gray-100 bg-gray-500 text-white dark:text-black rounded-full h-10 w-10 hover:bg-gray-700 dark:hover:bg-gray-300 block">
            <i class="fa-solid fa-moon"></i>
          </button>
          <a href="{{ route('cart.index') }}" id="cartBtn" class="relative inline-block">
            <span id="cartCount"
              class="absolute -top-2 -right-2 bg-blue-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">{{ session('cart') ? array_sum(session('cart')) : 0 }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="9" cy="21" r="1" />
              <circle cx="20" cy="21" r="1" />
              <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
            </svg>
          </a>
        </div>
      </div>
    </div>
    {{-- search bar --}}
    <div
      class="bg-black text-white text-center py-2 absolute -top-full left-0 right-0 transition-all flex justify-center"
      id="searchBar">
      <form action=""class="flex justify-center w-1/2" id="searchForm">
        <div class="relative w-full mx-10 h-10">
          <input placeholder="Search..."
            class="input shadow-lg border-gray-300 w-full px-2 py-2 rounded transition-all outline-none text-black"
            name="search" type="search" />
        </div>
      </form>
    </div>
  </nav>
  <div class="pt-20 bg-blue-600" id="quoteBar">
    {{-- promotion quote --}}
    <div class=" text-white text-center py-4">
      <p class="text-lg font-semibold">Welcome to Moroccan Amazon! Enjoy exclusive deals and discounts on your favorite
        products. Shop now and save big!</p>
    </div>
  </div>
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16">
    <h3 class="text-2xl font-semibold dark:text-gray-900 text-white">Find What You Love, Love What You Buy!</h3>
    <div id="products" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-6">
      <!-- Products will be inserted here -->
    </div>
  </main>

  <script>
    let products = [];
    const productsContainer = document.getElementById('products');
    const cartCount = document.getElementById('cartCount');

    // fetch products
    fetch("{{ route('home.products') }}", {
        method: 'GET',
        headers: {
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      })
      .then(response => response.json())
      .then(data => {
        products = data.products;
        renderProducts();
        updateCartCount();
      }).catch(error => {
        productsContainer.innerHTML = '<p class="text-red-500">Error loading products. Please try again later.</p>';
        console.error('Error fetching products:', error)
      });


    // add to cart function
    function addToCart(productId) {
      console.log(JSON.stringify({
        id: productId
      }));
      fetch(`{{ route('cart.add', '') }}/${productId}`, {
          method: 'POST',
          headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            id: productId
          })
        })
        .then(response => response.json())
        .then(data => {
          cart = data.cart;
          updateCartCount();
        }).catch(error => {
          console.error('Error fetching products:', error)
        });
    }

    // update cart count function 
    function updateCartCount() {
      fetch("{{ route('cart.count') }}", {
          method: 'GET',
          headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(response => response.json())
        .then(data => {
          cartCount.textContent = data.quantity;
        }).catch(error => {
          console.error('Error fetching products:', error)
        });
    }

    function renderProducts(data = products) {
      productsContainer.innerHTML = data.map(product => `
    <div class="bg-gray-800 border border-slate-700 dark:border-slate-200 dark:bg-slate-100 dark:text-black rounded-lg flex flex-col justify-between shadow-lg overflow-hidden transition-transform hover:scale-[1.02]">
      <a href="">
        <div class="h-64 overflow-hidden bg-white">
        <img
          src="${product.image}"
          alt="${product.name}"
          class="w-full h-full object-contain p-4"
        />
        </div>
      </a>
      <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-100 dark:text-black mb-2 line-clamp-1">
          ${product.name}
        </h3>
        <p class="text-gray-400 dark:text-gray-900 text-sm mb-4 line-clamp-2">
          ${product.description?? ""}
        </p>
        <div class="flex items-center justify-between mb-4">
          <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <span class="ml-1 text-sm text-gray-400">
              4/5 (300)
            </span>
          </div>
          <span class="text-xl font-bold text-gray-100 dark:text-black">
            ${Number(product.price).toFixed(2)} MAD
          </span>
        </div>
        <button
          onclick="addToCart(${product.id})"
          class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors"
        >
          Add to Cart
        </button>
      </div>
    </div>
    `).join('');
    }

    function showSearch() {
      const searchBar = document.getElementById('searchBar');
      const quoteBar = document.getElementById('quoteBar');
      if (searchBar.classList.contains('-top-full')) {
        searchBar.classList.remove('-top-full');
        quoteBar.classList.add('pt-32');
        quoteBar.classList.remove('pt-20');
      } else {
        searchBar.classList.add('-top-full');
        quoteBar.classList.add('pt-20');
        quoteBar.classList.remove('pt-32');
      }
    }

    const searchForm = document.getElementById('searchForm');
    searchForm.addEventListener('submit', (e) => {
      e.preventDefault();
    })
    searchForm.addEventListener('input', () => {
      const search = searchForm.querySelector('input[name="search"]').value;
      const filteredProducts = products.filter(product => product.name.toLowerCase().includes(search.toLowerCase()));
      if (filteredProducts.length === 0) {
        productsContainer.innerHTML =
          '<p class="text-gray-400 text-center text-2xl w-full flex-1">No products found.</p>';
      } else {
        renderProducts(filteredProducts);
      }
    })
    updateCartCount();
  </script>
</body>

</html>
