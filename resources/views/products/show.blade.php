@vite('resources/js/deleteItem.js')
@extends('layouts.admin')
@section('title', 'Product details')
@section('page', 'products')
@section('content')
  <div class="mx-auto w-full bg-slate-900 dark:bg-gray-100">
    <div class="flex justify-between items-center mb-4 p-4 dark:bg-white bg-slate-800 w-full">
      <div class="flex flex-col gap-2 md:flex-row w-full">

        <a href="{{ route('products.index') }}"
          class="dark:bg-gray-100 bg-gray-500 hover:bg-gray-700 dark:hover:bg-gray-300 text-white dark:text-black px-4 py-2 rounded block w-fit">
          <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="text-2xl font-bold ">Product with id : {{ $product->id }}</h1>
      </div>
      <div class="flex flex-col gap-2 md:flex-row">
        <button onclick="toggleDarkMode()"
          class="dark:bg-gray-100 bg-gray-500 text-white dark:text-black rounded-full h-10 w-10 hover:bg-gray-700 dark:hover:bg-gray-300 block">
          <i class="fa-solid fa-moon"></i>
        </button>
      </div>
    </div>

    <div class="max-w-2xl mx-auto p-6 dark:bg-white bg-slate-800 shadow-md rounded-lg mt-10">
      <h1 class="text-2xl font-bold dark:text-slate-800 text-slate-200 mb-4">Details of product with id :
        {{ $product->id }}</h1>
      <table class="min-w-full dark:bg-white bg-slate-800 dark:text-gray-700 text-gray-300">
        <thead class="bg-slate-700 text-white dark:bg-gray-200 dark:text-black rounded-md">
          <tr>
            <th class="py-2 px-4 font-semibold text-start">Attribute</th>
            <th class="py-2 px-4 font-semibold dark:text-gray-700 :text-gray-300 text-start">Value</th>
          </tr>
        </thead>
        <tbody>
          <tr class="w-full border-b dark:border-gray-700">
            <td class="py-2 px-4 font-semibold ">Name :</td>
            <td class="py-2 px-4 ">{{ $product->name }}</td>
          </tr>
          <tr class="w-full border-b dark:border-gray-700">
            <td class="py-2 px-4 font-semibold ">Price :</td>
            <td class="py-2 px-4 ">{{ $product->price }}</td>
          </tr>
          <tr class="w-full border-b dark:border-gray-700">
            <td class="py-2 px-4 font-semibold ">Stock :</td>
            <td class="py-2 px-4 ">{{ $product->stock }}</td>
          </tr>
          <tr class="w-full border-b dark:border-gray-700">
            <td class="py-2 px-4 font-semibold ">Description :</td>
            <td class="py-2 px-4 ">{{ $product->description }}</td>
          </tr>
          <tr class="w-full border-b dark:border-gray-700">
            <td class="py-2 px-4 font-semibold ">Category :</td>
            <td class="py-2 px-4 ">{{ $product->category->name }}</td>
          </tr>
        </tbody>
      </table>

      <div class="w-full flex justify-end flex-wrap gap-2 py-4 font-bold">
        <a href="{{ route('products.edit', $product->id) }}"
          class="block dark:bg-yellow-500 dark:hover:bg-yellow-600 bg-yellow-400 hover:bg-yellow-500 px-4 py-2 w-fit rounded-lg dark:text-white text-black">Modify</a>
        <button
          class="dark:bg-red-500 dark:hover:bg-red-600 bg-red-400 hover:bg-red-500 w-fit px-4 py-2 rounded-lg dark:text-white text-black deleteButton"
          data-id="{{ $product->id }}" title="Delete" id="showDeleteButton">Delete</button>
      </div>
    </div>
    <div class="w-full h-full fixed top-0 left-0 hidden justify-center items-center" id="deleteModalDiv">


      <div
        class="relative transform overflow-hidden rounded-lg dark:bg-white bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
        <div class="dark:bg-white bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div
              class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full dark:bg-red-100 bg-red-200 sm:mx-0 sm:size-10">
              <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
              </svg>
            </div>
            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
              <h3 class="text-base font-semibold dark:text-gray-900 text-gray-100" id="modal-title">Delete the product
              </h3>
              <div class="mt-2">
                <p class="text-sm dark:text-gray-500 text-gray-300">Are you sure you want to delete this product? This
                  action is irreversible.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="dark:bg-gray-50 bg-gray-700 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
          <form action="" method="POST" class="deleteForm m-0" id="">
            @csrf
            @method('DELETE')
            <button type="submit" id="deleteConfirm" data-form="{{ 'show' }}"
              class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Delete</button>
          </form>
          <button type="button" id="cancelDelete"
            class="mt-3 inline-flex w-full justify-center rounded-md dark:bg-white bg-gray-800 px-3 py-2 text-sm font-semibold dark:text-gray-900 text-gray-100 shadow-sm ring-1 ring-inset dark:ring-gray-300 ring-gray-600 dark:hover:bg-gray-50 hover:bg-gray-700 sm:mt-0 sm:w-auto">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    const deleteRouteBaseUrl = "{{ url('products') }}";
  </script>
@endsection
