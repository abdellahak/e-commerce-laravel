@vite('resources/js/deleteItem.js')
@extends('layouts.admin')
@section('title', 'commands list')
@section('page', 'commands')
@section('content')
  <div class="w-full mx-auto bg-slate-900 dark:bg-gray-100 flex flex-col h-screen">
    <div class="flex justify-between items-center mb-4 p-4 dark:bg-white bg-gray-800 w-full">
      <h1 class="text-2xl font-bold">Commands list</h1>
      <div class="flex flex-col gap-2 md:flex-row pr-4">
        <a href="{{ route('commands.create') }}"
          class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 block">Add command</a>
        <button onclick="toggleDarkMode()"
          class="dark:bg-gray-100 bg-gray-500 text-white dark:text-black rounded-full h-10 w-10 hover:bg-gray-700 dark:hover:bg-gray-300 block">
          <i class="fa-solid fa-moon"></i>
        </button>
      </div>
    </div>
    <div class="container flex flex-col lg:flex-row p-4 pt-0 justify-between">
      <div class="container flex flex-col lg:flex-row gap-2">
        <div class="flex flex-row items-center">
          <p class="bg-slate-800 dark:bg-gray-200 w-full lg:w-  fit px-2 py-2 rounded-l-lg ">commands number
            : </p>
          <p
            class="bg-blue-600 dark:bg-blue-600 text-white rounded-r-lg font-semibold px-2 py-2 min-w-14 lg:min-w-fit text-center">
            {{ count($commands) }}
          </p>
        </div>
      </div>
      <div class="my-2 lg:my-0 pr-4">
        <p class="px-1 text-sm">filter by Category</p>
        <form action="{{ route('commands.filterByStatus') }}" id="filterForm"
          class="max-w-sm mx-auto flex flex-col md:flex-row gap-2">
          <select id="commands" name="status"
            class="w-fit my-2 px-2 py-2 rounded focus:outline-none dark:text-black text-white bg-slate-700 dark:bg-gray-200 cursor-pointer">
            <option value="-1">All stats</option>
            <option value="in progress" @if (request('status') == 'in progress') selected @endif>In progress</option>
            <option value="Sent" @if (request('status') == 'Sent') selected @endif>Sent</option>
            <option value="delivered" @if (request('status') == 'delivered') selected @endif>Delivered</option>
            <option value="return" @if (request('status') == 'return') selected @endif>Return</option>
          </select>
        </form>
      </div>
    </div>

    <div
      class="p-4 lg:overflow-y-auto relative pt-0 scrollbar dark:scrollbar-thumb-gray-300 dark:scrollbar-track-gray-100 scrollbar-thumb-gray-700 scrollbar-track-gray-900">
      <table class="min-w-full shadow-md">
        <thead class="bg-slate-800 text-white dark:bg-gray-200 dark:text-black rounded-md sticky top-0">
          <tr>
            <th class="py-2 px-4 text-start">Id</th>
            <th class="py-2 px-4 text-start">Client</th>
            <th class="py-2 px-4 text-start">Date</th>
            <th class="py-2 px-4 text-start">Amount</th>
            <th class="py-2 px-4 text-start">Status</th>
            <th class="py-2 px-4 text-center" colspan="3">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($commands as $item)
            <tr class="hover:bg-slate-700 dark:hover:bg-gray-300" id="item-{{ $item->id }}">
              <td class="py-2 px-4">{{ $item->id }}</td>
              <td class="py-2 px-4">

                {{ $item->client->first_name }} {{ $item->client->last_name }}
              </td>
              <td class="py-2 px-4">{{ $item->date }}</td>
              <td class="py-2 px-4">{{ $item->amount }}</td>
              <td class="py-2 px-4">

                <form action="{{ route('commands.status', $item->id) }}" class="flex items-center gap-2 statusForm">
                  <select name="status" id="status"
                    @if ($item->status == 'in progress') class="inline-block text-nowrap px-1 min-w-1/2 text-center bg-slate-800 dark:bg-slate-400 dark:text-slate-800 text-slate-400 p-1 rounded font-medium"
                @elseif($item->status == 'sent')
                    class="inline-block text-nowrap px-1 min-w-1/2 text-center bg-blue-600 bg-opacity-90 text-slate-900 p-1 rounded font-semibold"
                @elseif($item->status == 'delivered')
                    class="inline-block text-nowrap px-1 min-w-1/2 text-center bg-green-400 text-green-900 p-1 rounded font-medium"
                    class="inline-block text-nowrap px-1 min-w-1/2 text-center bg-green-400 text-green-900 p-1 rounded font-medium"
                @else
                    class="inline-block text-nowrap px-1 min-w-1/2 text-center bg-red-300 text-red-900 p-1 rounded font-medium" @endif>
                    <option value="in progress" @if ($item->status == 'in progress') selected @endif
                      class="text-center bg-slate-800 dark:bg-slate-400 dark:text-slate-800 text-slate-400 font-medium">• In
                      progress</option>
                    <option value="sent" @if ($item->status == 'sent') selected @endif
                      class="text-center bg-slate-800 dark:bg-slate-400 dark:text-slate-800 text-slate-400 font-medium">
                      • Sent</option>
                    <option value="delivered" @if ($item->status == 'delivered') selected @endif
                      class="text-center bg-slate-800 dark:bg-slate-400 dark:text-slate-800 text-slate-400 font-medium">
                      • Delivered</option>
                    <option value="return" @if ($item->status == 'return') selected @endif
                      class="text-center bg-slate-800 dark:bg-slate-400 dark:text-slate-800 text-slate-400 font-medium">
                      • Return</option>
                  </select>
                </form>
              </td>
              <td class="py-2 px-4 text-center">
                <a href="{{ route('commands.show', $item->id) }}" class="text-blue-500 hover:underline" title="Details">
                  <i class="fa-solid fa-circle-info"></i>
                </a>
              </td>
              <td class="py-2 px-4 text-center">
                <a href="{{ route('commands.edit', $item->id) }}" class="text-yellow-500 hover:underline"
                  title="Modifier">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
              </td>
              <td class="py-2 px-4 text-center">
                <button type="button" data-id="{{ $item->id }}" class="deleteButton" title="Delete">
                  <i class="fa-solid fa-trash text-red-500"></i>
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="w-full h-full fixed top-0 left-0 hidden justify-center items-center" id="deleteModalDiv">


        <div
          class="relative transform overflow-hidden rounded-lg dark:bg-white bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
          <div class="dark:bg-white bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div
                class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full dark:bg-red-100 bg-red-200 sm:mx-0 sm:size-10">
                <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" aria-hidden="true" data-slot="icon">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
              </div>
              <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                <h3 class="text-base font-semibold dark:text-gray-900 text-gray-100" id="modal-title">Delete the command
                </h3>
                <div class="mt-2">
                  <p class="text-sm dark:text-gray-500 text-gray-300">Are you sure you want to delete this command? This
                    action is irreversible.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="dark:bg-gray-50 bg-gray-700 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <form action="" method="POST" class="deleteForm m-0" id="">
              @csrf
              @method('DELETE')
              <button type="submit" id="deleteConfirm"
                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Delete</button>
            </form>
            <button type="button" id="cancelDelete"
              class="mt-3 inline-flex w-full justify-center rounded-md dark:bg-white bg-gray-800 px-3 py-2 text-sm font-semibold dark:text-gray-900 text-gray-100 shadow-sm ring-1 ring-inset dark:ring-gray-300 ring-gray-600 dark:hover:bg-gray-50 hover:bg-gray-700 sm:mt-0 sm:w-auto">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const deleteRouteBaseUrl = "{{ url('commands') }}";
    const filterForm = document.getElementById('filterForm');
    filterForm.addEventListener('change', () => {
      filterForm.submit();
    });

    // change status code :
    const statusForms = document.querySelectorAll('.statusForm');
    statusForms.forEach(element => {
      element.addEventListener('change', () => {
        element.submit();
      })
    });
  </script>
@endsection
