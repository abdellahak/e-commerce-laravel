@extends('layouts.admin')
@section('title', 'Add a product')
@section('page', 'products')
@section('aside')
@endsection
@section('content')
  <div class="mx-auto w-full bg-slate-900 dark:bg-gray-100">
    <div class="flex justify-between items-center mb-4 p-4 dark:bg-white bg-gray-800 w-full">
      <div class="flex flex-col gap-2 md:flex-row w-full">
        <a href="{{ route('products.index') }}"
          class="dark:bg-gray-100 bg-gray-500 hover:bg-gray-700 dark:hover:bg-gray-300 text-white dark:text-black px-4 py-2 rounded block w-fit">
          <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="text-2xl font-bold ">Add a Product</h1>
      </div>
      <div class="flex flex-col gap-2 md:flex-row">
        <button onclick="toggleDarkMode()"
          class="dark:bg-gray-100 bg-gray-500 text-white dark:text-black rounded-full h-10 w-10 hover:bg-gray-700 dark:hover:bg-gray-300 block">
          <i class="fa-solid fa-moon"></i>
        </button>
      </div>
    </div>
    <div class="max-w-2xl mx-auto p-6 dark:bg-white bg-slate-800 shadow-md rounded-lg">
      <h1 class="text-2xl font-bold mb-6">Add product:</h1>
      @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="my-4">
          <label for="name" class="block dark:text-gray-700 text-gray-100 mb-1 text-lg ">Name :</label>
          <input type="text" id="name" name="name" value="{{ old('name') }}"
            class="w-full mb-2 px-2 py-2 rounded focus:outline-none dark:text-black text-white bg-slate-700 dark:bg-gray-200 ">
        </div>
        <div class="grid gap-2 grid-cols-1 lg:grid-cols-2">
          <div class="mb-4">
            <label for="price" class="block dark:text-gray-700 text-gray-100 mb-1 text-lg ">Price :</label>
            <input type="number" id="price" name="price" step="0.01" value="{{ old('price') }}"
              class="w-full mb-2 px-2 py-2 rounded focus:outline-none dark:text-black text-white bg-slate-700 dark:bg-gray-200 ">
          </div>
          <div class="mb-4">
            <label for="stock" class="block dark:text-gray-700 text-gray-100 mb-1 text-lg">Stock :</label>
            <input type="number" id="stock" name="stock" value="{{ old('stock') }}"
              class="w-full mb-2 px-2 py-2 rounded focus:outline-none dark:text-black text-white bg-slate-700 dark:bg-gray-200 ">
          </div>
        </div>
        <div class="mb-4">
          <label for="category_id" class="block dark:text-gray-700 text-gray-100 mb-1 text-lg">Category :</label>
          <select name="category_id" id="category_id"
            class="w-full mb-2 p-2 rounded focus:outline-none dark:text-black text-white bg-slate-700 dark:bg-gray-200 ">
            <option value="">Select a category</option>
            @foreach ($categories as $item)
              <option value="{{ $item->id }}" @if (old('category_id') == $item->id) selected @endif>{{ $item->name }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="my-4">
          <label for="image" class="block dark:text-gray-700 text-gray-100 mb-1 text-lg ">Image :</label>
          <input type="file" id="file_input" name="image"
            class="p-2 block w-full text-sm dark:text-gray-900 border dark:border-gray-300 rounded-lg cursor-pointer dark:bg-gray-50 text-gray-400 focus:outline-none bg-gray-700 border-gray-600 dark:placeholder-gray-400">
          <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 2Mb).
          </p>
        </div>
        <div class="border-b border-slate-700 dark:border-gray-900/10 pb-2 mb-2">
          <label for="description" class="block dark:text-gray-700 text-gray-100 mb-1 text-lg ">Description :</label>
          <textarea name="description" id="description" cols="30" rows="3"
            class="w-full mb-2 p-2 rounded focus:outline-none dark:text-black text-white bg-slate-700 dark:bg-gray-200 ">{{ old('description') }}</textarea>
        </div>
        <div class="text-right">
          <input type="submit" value="Add Product "
            class="p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
        </div>
      </form>
    </div>
  </div>
@endsection
