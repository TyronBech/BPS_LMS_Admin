@extends('layouts.admin-app')
@section('content')
<h1 class="font-semibold text-center text-4xl p-5">Report Document</h1>
  <form action="{{ route('report.visitor-retrieve') }}" method="POST">
    @csrf
    <input type="hidden" id="shownData" name="shownData" value="{{ json_encode($data) }}">
    <div class="container flex flex-row justify-center">
      <div id="date-range-picker" date-rangepicker class="flex items-center">
        <div class="relative">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
              </svg>
          </div>
          <input id="datepicker-range-start" name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start" value="<?php echo $fromInputDate; ?>">
        </div>
        <span class="mx-4 text-gray-500">to</span>
        <div class="relative">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
              </svg>
          </div>
          <input id="datepicker-range-end" name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end" value="<?php echo $toInputDate; ?>">
        </div>
      </div>
      <div class="sm:col-span-2 sm:col-start-1 flex items-center">
        <label for="first-name" class="block text-sm/6 font-medium text-gray-900 mr-2 ml-4">Name:</label>
        <div class="">
          <input type="text" name="first-name" id="first-name" placeholder="Juan" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 min-w-[140px]" value="<?php echo $inputName; ?>">
        </div>
      </div>
      <div class="sm:col-span-2 sm:col-start-1 flex items-center">
        <label for="last-name" class="block text-sm/6 font-medium text-gray-900 mr-2 ml-4">Surname:</label>
        <div class="">
          <input type="text" name="last-name" id="last-name" placeholder="Dela Cruz" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 min-w-[140px]" value="<?php echo $inputLastName; ?>">
        </div>
      </div>
      <div class="sm:col-span-2 sm:col-start-1 flex items-center">
        <button type="submit" id="findBtn" name="findBtn" class="bg-blue-500 hover:bg-blue-700 active:bg-blue-900 text-white text-sm font-bold py-1 px-4 rounded h-12 mt-2 mb-2 ml-4 mr-4 w-20">Find</button>
        <button type="submit" id="findAllBtn" name="findAllBtn" class="bg-blue-500 hover:bg-blue-700 active:bg-blue-900 text-white text-sm font-bold py-1 px-4 rounded h-12 mt-2 mb-2 ml-4 mr-4 w-20">Find All</button>
        <button type="submit" id="pdfBtn" name="pdfBtn" class="bg-red-500 hover:bg-red-700 active:bg-red-900 text-white text-sm font-bold py-1 px-4 rounded h-12 mt-2 mb-2 ml-4 mr-4 w-20">Export PDF</button>
        <button type="submit" id="excelBtn" name="excelBtn" class="bg-green-500 hover:bg-green-700 active:bg-green-900 text-white text-sm font-bold py-1 px-4 rounded h-12 mt-2 mb-2 ml-4 mr-4 w-20">Export Excel</button>
      </div>
    </div>
  </form>
  <h1 class="text-md font-extrabold">PEAK HOUR: <small class="ms-2 font-semibold text-gray-500">{{ $peak_hour }}</small></h1>
  @include('report.visitors.visitor-logs-table')
@endsection
@section('scripts')
@vite('resources/js/report-buttons.js')
@endsection