<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
  <title>Moroccan amazon cart</title>
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

<body class="bg-gray-900 dark:bg-slate-100 text-gray-100 dark:text-black">
  <nav class="fixed top-0 left-0 right-0 bg-gray-800 dark:bg-gray-50 dark:text-black shadow-lg z-50 w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        <a href="{{ route('home') }}">
          <h1 class="text-2xl font-bold">
            <i class="fa-solid fa-store mx-2"></i>
            Moroccan Amazon
          </h1>
        </a>
        <div class="flex items-center gap-4">
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
  </nav>



  <section class="antialiased md:py-16 pt-44 pb-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-24 2xl:px-0 mt-10 ">
      <h2 class="text-xl font-semibold sm:text-2xl">Shopping Cart</h2>

      <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
        <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl flex flex-col gap-2 " id="cartItems">

        </div>

        {{-- order summary --}}
        <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
          <div
            class="space-y-4 rounded-lg border dark:border-gray-200 dark:bg-white p-4 shadow-sm border-gray-700 bg-gray-800 sm:p-6">
            <p class="text-xl font-semibold dark:text-gray-900 text-white">Order summary</p>

            {{-- <div class="space-y-4">
              <div class="space-y-2">
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal dark:text-gray-500 text-gray-400">Original price</dt>
                  <dd class="text-base font-medium dark:text-gray-900 text-white">$7,592.00</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal dark:text-gray-500 text-gray-400">Savings</dt>
                  <dd class="text-base font-medium text-green-600">-$299.00</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal dark:text-gray-500 text-gray-400">Store Pickup</dt>
                  <dd class="text-base font-medium dark:text-gray-900 text-white">$99</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal dark:text-gray-500 text-gray-400">Tax</dt>
                  <dd class="text-base font-medium dark:text-gray-900 text-white">$799</dd>
                </dl>
              </div> --}}

            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
              <dt class="text-base font-bold dark:text-gray-900 text-white">Total</dt>
              <dd class="text-base font-bold dark:text-gray-900 text-white" id="total">0 MAD</dd>
            </dl>
          </div>

          <a href="#"
            class="flex w-full items-center justify-center rounded-lg dark:bg-blue-700 px-5 py-2.5 text-sm font-medium text-white dark:hover:bg-blue-800 focus:outline-none focus:ring-4 dark:focus:ring-primary-300 bg-blue-600 hover:bg-blue-700 focus:ring-primary-800">Proceed
            to Checkout</a>

          <div class="flex items-center justify-center gap-2">
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
            <a href="{{ route('home') }}"
              class="inline-flex items-center gap-2 text-sm font-medium dark:text-blue-700 underline hover:no-underline text-blue-600">
              Continue Shopping
              <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 12H5m14 0-4 4m4-4-4-4" />
              </svg>
            </a>
          </div>
        </div>


      </div>
    </div>


    {{-- other products --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16">
      <h3 class="text-2xl font-semibold dark:text-gray-900 text-white">People also bought</h3>
      <div class="mt-6 grid grid-cols-3 gap-4 sm:mt-8">
        <div
          class="space-y-6 overflow-hidden rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
          <a href="#" class="overflow-hidden rounded">
            <img class="mx-auto h-44 w-44 dark:hidden"
              src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="imac image" />
            <img class="mx-auto hidden h-44 w-44 dark:block"
              src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="imac image" />
          </a>
          <div>
            <a href="#"
              class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">iMac
              27”</a>
            <p class="mt-2 text-base font-normal text-gray-500 dark:text-gray-400">This generation has some
              improvements, including a longer continuous battery life.</p>
          </div>
          <div>
            <p class="text-lg font-bold text-gray-900 dark:text-white">
              <span class="line-through"> $399,99 </span>
            </p>
            <p class="text-lg font-bold leading-tight text-red-600 dark:text-red-500">$299</p>
          </div>
          <div class="mt-6 flex items-center gap-2.5">
            <button data-tooltip-target="favourites-tooltip-1" type="button"
              class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white p-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
              <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"></path>
              </svg>
            </button>
            <div id="favourites-tooltip-1" role="tooltip"
              class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
              Add to favourites
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <button type="button"
              class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium  text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
              <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4" />
              </svg>
              Add to cart
            </button>
          </div>
        </div>
        <div
          class="space-y-6 overflow-hidden rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
          <a href="#" class="overflow-hidden rounded">
            <img class="mx-auto h-44 w-44 dark:hidden"
              src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ps5-light.svg" alt="imac image" />
            <img class="mx-auto hidden h-44 w-44 dark:block"
              src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ps5-dark.svg" alt="imac image" />
          </a>
          <div>
            <a href="#"
              class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">Playstation
              5</a>
            <p class="mt-2 text-base font-normal text-gray-500 dark:text-gray-400">This generation has some
              improvements, including a longer continuous battery life.</p>
          </div>
          <div>
            <p class="text-lg font-bold text-gray-900 dark:text-white">
              <span class="line-through"> $799,99 </span>
            </p>
            <p class="text-lg font-bold leading-tight text-red-600 dark:text-red-500">$499</p>
          </div>
          <div class="mt-6 flex items-center gap-2.5">
            <button data-tooltip-target="favourites-tooltip-2" type="button"
              class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white p-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
              <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"></path>
              </svg>
            </button>
            <div id="favourites-tooltip-2" role="tooltip"
              class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
              Add to favourites
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <button type="button"
              class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium  text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
              <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4" />
              </svg>
              Add to cart
            </button>
          </div>
        </div>
        <div
          class="space-y-6 overflow-hidden rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
          <a href="#" class="overflow-hidden rounded">
            <img class="mx-auto h-44 w-44 dark:hidden"
              src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/apple-watch-light.svg" alt="imac image" />
            <img class="mx-auto hidden h-44 w-44 dark:block"
              src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/apple-watch-dark.svg" alt="imac image" />
          </a>
          <div>
            <a href="#"
              class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">Apple
              Watch
              Series 8</a>
            <p class="mt-2 text-base font-normal text-gray-500 dark:text-gray-400">This generation has some
              improvements, including a longer continuous battery life.</p>
          </div>
          <div>
            <p class="text-lg font-bold text-gray-900 dark:text-white">
              <span class="line-through"> $1799,99 </span>
            </p>
            <p class="text-lg font-bold leading-tight text-red-600 dark:text-red-500">$1199</p>
          </div>
          <div class="mt-6 flex items-center gap-2.5">
            <button data-tooltip-target="favourites-tooltip-3" type="button"
              class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white p-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
              <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"></path>
              </svg>
            </button>
            <div id="favourites-tooltip-3" role="tooltip"
              class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
              Add to favourites
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>

            <button type="button"
              class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium  text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
              <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4" />
              </svg>
              Add to cart
            </button>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <script>
    let cartProducts = [];
    let cart = [];
    const cartItems = document.getElementById('cartItems');
    const cartCount = document.getElementById('cartCount');
    const cartBtn = document.getElementById('cartBtn');
    const total = document.getElementById('total');
    getData();

    function getData() {
      fetch('{{ route('cart.index') }}', {
          method: 'GET',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(response => response.json())
        .then(data => {
          cartProducts = data.products;
          cart = data.cart;
          total.textContent = `${data.total} MAD`;
          renderCartItems();
        });
    }


    function increment(id) {
      fetch(`{{ route('cart.increment', '') }}/${id}`, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
        }).then(response => response.json())
        .then(data => {
          getData();
          total.textContent = `${data.total} MAD`;
          renderCartItems();
        });
    }

    function decrement(id) {
      fetch(`{{ route('cart.decrement', '') }}/${id}`, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
        }).then(response => response.json())
        .then(data => {
          getData();
          total.textContent = `${data.total} MAD`;
          renderCartItems();
        });
    }

    function remove(id) {
      fetch(`{{ route('cart.remove', '') }}/${id}`, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
        }).then(response => response.json())
        .then(data => {
          getData();
          total.textContent = `${data.total} MAD`;
          renderCartItems();
        });
    }


    // update cart count 
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

    function renderCartItems(data = cartProducts) {
      updateCartCount();
      cartItems.innerHTML = data.map((product) => `
          <div class="space-y-6">
              <div
                class="rounded-lg border dark:border-gray-200 dark:bg-white p-4 shadow-sm border-gray-700 bg-gray-800 md:p-6">
                <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                  <a href="#" class="shrink-0 md:order-1">
                    <img class="h-20 w-20 object-contain bg-white" src="${product.image}"
                      alt="${product.name}" />
                  </a>

                  <label for="counter-input" class="sr-only">Choose quantity:</label>
                  <div class="flex items-center justify-between md:order-3 md:justify-end">
                    <div class="flex items-center">
                      <button type="button" id="decrement-button" data-input-counter-decrement="counter-input" onclick="decrement(${product.id})"
                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border dark:border-gray-300 dark:bg-gray-100 dark:hover:bg-gray-200 focus:outline-none focus:ring-2 dark:focus:ring-gray-100 border-gray-600 bg-gray-700 hover:bg-gray-600 focus:ring-gray-700">
                        <svg class="h-2.5 w-2.5 dark:text-gray-900 text-white" aria-hidden="true"
                          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h16" />
                        </svg>
                      </button>
                      <input type="text" id="counter-input" disabled
                        class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium dark:text-gray-900 focus:outline-none focus:ring-0 text-white"
                        placeholder="" value="${cart[product.id]}" required />
                      <button type="button" id="increment-button" data-input-counter-increment="counter-input" onclick="increment(${product.id})"
                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border dark:border-gray-300 dark:bg-gray-100 dark:hover:bg-gray-200 focus:outline-none focus:ring-2 dark:focus:ring-gray-100 border-gray-600 bg-gray-700 hover:bg-gray-600 focus:ring-gray-700">
                        <svg class="h-2.5 w-2.5 dark:text-gray-900 text-white" aria-hidden="true"
                          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                        </svg>
                      </button>
                    </div>
                    <div class="text-end md:order-4 md:w-32">
                      <p class="text-base font-bold dark:text-gray-900 text-white ">${Number(product.price * cart[product.id]).toFixed(2)} MAD</p>
                    </div>
                  </div>

                  <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                    <a href="#" class="font-medium dark:text-gray-900 hover:underline text-white text-2xl">
                      ${product.name}
                    </a>

                    <div class="flex items-center gap-4">
                    

                      <button type="button" onclick="remove(${product.id})"
                        class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                        <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                          height="24" fill="none" viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        Remove
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>  
        `).join('');
    }
  </script>
</body>

</html>
