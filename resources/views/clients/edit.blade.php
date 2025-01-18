@extends('layouts.admin')
@section('title', 'Update client')
@section('page', 'clients')

@section('content')
  <div class="mx-auto w-full bg-slate-900 dark:bg-gray-100">
    <div class="flex justify-between items-center mb-4 p-4 dark:bg-white bg-slate-800 w-full">
      <div class="flex flex-col gap-2 md:flex-row w-full">

        <a href="{{ route('clients.index') }}"
          class="dark:bg-gray-100 bg-gray-500 hover:bg-gray-700 dark:hover:bg-gray-300 text-white dark:text-black px-4 py-2 rounded block w-fit">
          <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="text-2xl font-bold ">Update a client</h1>
      </div>
      <div class="flex flex-col gap-2 md:flex-row">
        <button onclick="toggleDarkMode()"
          class="dark:bg-gray-100 bg-gray-500 text-white dark:text-black rounded-full h-10 w-10 hover:bg-gray-700 dark:hover:bg-gray-300 block">
          <i class="fa-solid fa-moon"></i>
        </button>
      </div>
    </div>

    <div class="max-w-2xl mx-auto p-6 dark:bg-white bg-slate-800  shadow-md rounded-lg">
      <h1 class="text-2xl font-bold mb-6">Update the client with id : {{ $client->id }}</h1>
      @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="my-4">
          <label for="first_name" class="block dark:text-gray-700 text-gray-100 mb-2 text-lg ">First Name :</label>
          <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $client->first_name) }}"
            class="w-full my-2 px-2 py-2 rounded focus:outline-none dark:text-black text-white bg-slate-700 dark:bg-gray-200 ">
        </div>
        <div class="my-4">
          <label for="last_name" class="block dark:text-gray-700 text-gray-100 mb-2 text-lg ">Last Name :</label>
          <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $client->last_name) }}"
            class="w-full my-2 px-2 py-2 rounded focus:outline-none dark:text-black text-white bg-slate-700 dark:bg-gray-200 ">
        </div>
        <div class="grid gap-2 grid-cols-1 lg:grid-cols-2">
          <div class="mb-4">
            <label for="phone" class="block dark:text-gray-700 text-gray-100 mb-2 text-lg ">Phone :</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $client->phone) }}"
              class="w-full my-2 px-2 py-2 rounded focus:outline-none dark:text-black text-white bg-slate-700 dark:bg-gray-200 ">
          </div>
          <div class="mb-4">
            <label for="city" class="block dark:text-gray-700 text-gray-100 my-2 text-lg ">City :</label>
            <select name="city" value="" id="city"
              class="w-full mb-2 p-2 rounded focus:outline-none dark:text-black text-white bg-slate-700 dark:bg-gray-200 ">
              <option value="">Select a city</option>
              @foreach ($cities as $item)
                <option value="{{ $item }}" {{ $item == old('city', $client->city) ? 'selected' : '' }}>
                  {{ $item }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="mb-4">
          <label for="birthday" class="block dark:text-gray-700 text-gray-100 mb-2 text-lg">Birthday
            :</label>
          <input type="date" id="birthday" name="birthday" value="{{ old('birthday', $client->birthday) }}"
            class="w-full my-2 px-2 py-2 rounded focus:outline-none dark:text-black text-white bg-slate-700 dark:bg-gray-200 ">
        </div>
        <div class="text-right">
          <input type="submit" value="Update"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
        </div>
      </form>
    </div>
  </div>
@endsection
