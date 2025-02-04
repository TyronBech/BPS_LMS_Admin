@extends('layouts.welcome-layout')
@section('content')
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