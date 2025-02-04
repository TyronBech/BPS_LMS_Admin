@extends('layouts.admin-app')
@section('content')
<h1 class="font-semibold text-center text-4xl p-5">Book Circulation</h1>
  <form action="{{ route('report.book-circulation-retrieve') }}" method="POST">
    @csrf
    <div class="container flex flex-row justify-center">
      <div class="sm:col-span-2 sm:col-start-1 flex items-center">
        <label for="barcode" class="block text-sm/6 font-medium text-gray-900 mr-2 ml-4">Barcode:</label>
        <div class="">
          <input type="text" name="barcode" id="barcode" placeholder="123-456-789" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 min-w-[140px]" value="<?php echo $barcode; ?>">
        </div>
      </div>
      <div class="sm:col-span-2 sm:col-start-1 flex items-center">
        <label for="title" class="block text-sm/6 font-medium text-gray-900 mr-2 ml-4">Title:</label>
        <div class="">
          <input type="text" name="title" id="title" placeholder="Atomic Habits" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 min-w-[140px]" value="<?php echo $title; ?>">
        </div>
      </div>
      <div class="sm:col-span-2 sm:col-start-1 flex items-center">
        <label for="availability" class="block mb-2 text-sm font-medium text-gray-900 mr-2 ml-4">Select:</label>
        <select id="availability" name="availability" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
          <option selected>Choose availability status</option>
          <option value="available">Available</option>
          <option value="borrowed">Borrowed</option>
          <option value="reserved">Reserved</option>
        </select>
      </div>
      <div class="sm:col-span-2 sm:col-start-1 flex items-center">
        <button type="submit" id="findBtn" name="findBtn" class="bg-blue-500 hover:bg-blue-700 active:bg-blue-900 text-white text-sm font-bold py-1 px-4 rounded h-12 mt-2 mb-2 ml-6 mr-4 w-20">Find</button>
        <button type="submit" id="findAllBtn" name="findAllBtn" class="bg-blue-500 hover:bg-blue-700 active:bg-blue-900 text-white text-sm font-bold py-1 px-4 rounded h-12 mt-2 mb-2 ml-4 mr-4 w-20">Find All</button>
      </div>
    </div>
  </form>
  @include('report.book-circulations.book-circulations-table')
@endsection
@section('scripts')
@vite('resources/js/report-buttons.js')
@endsection