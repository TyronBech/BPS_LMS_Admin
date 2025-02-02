@extends('layouts.welcome-layout')
@section('content')
@if(session('login-error'))
<div id="message" name="message" class="flex absolute top-4 z-10 right-[-100px] items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow" role="alert">
  <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
    </svg>
    <span class="sr-only">Error icon</span>
  </div>
  <div class="ms-3 text-sm font-normal">{{ session('login-error') }}</div>
  <button type="button" id="closeBtn" name="closeBtn" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="message" aria-label="Close">
    <span class="sr-only">Close</span>
    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
    </svg>
  </button>
</div>
@endif
<div class="flex justify-between items-center my-20">
  <img class="rounded-full w-96 h-96" src="{{ asset('img/School Logo.png') }}" alt="School Logo">
  <div class="flex flex-col justify-evenly">
    <h1 class="lg:text-2xl md:text-lg text-black font-semibold text-center">Bicutan Parochial School</h1>
    <hr class="h-px bg-gray-500 border-0 my-2">
    <h1 class="lg:text-xl md:text-md text-black font-semibold text-center">Library Management System</h1>
    <h4 class="lg:text-lg md:text-sm text-black font-semibold text-center my-4">Developed by</h4>
    <h1 class="lg:text-2xl md:text-lg text-black font-semibold text-center">OwlQuery Group</h1>
  </div>
  <img class="rounded-full w-96 h-96" src="{{ asset('img/OwlQuery.png') }}" alt="OwlQuery">
</div>
@endsection