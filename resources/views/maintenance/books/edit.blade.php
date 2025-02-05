@extends('layouts.admin-app')
@section('content')
<h1 class="font-semibold text-center text-4xl p-5">Maintenance</h1>
<div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
  <div class="flex justify-between">
    <h5 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">Add Book</h5>
    <a href="{{ route('maintenance.books') }}" class="inline-flex items-center px-3 py-1 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
      Back
      <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
      </svg>
    </a>
  </div>
  <hr class="h-px my-3 bg-gray-200 border-0">
  <form action="{{ route('maintenance.update-book') }}" class="max-w-2xl mx-auto" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $book->accession }}">
    <h6 class="mb-1 text-xl font-semibold tracking-tight text-gray-800">Book Information</h6>
    <div class="mb-5">
      <label for="accession" name="accession" class="block mb-2 text-sm font-medium text-gray-900">Accession Number:</label>
      <input type="text" id="accession" name="accession" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="FIL0123456789" value="{{ $book->accession }}">
      @error('accession')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="call_number" name="call_number" class="block mb-2 text-sm font-medium text-gray-900">Call Number:</label>
      <input type="text" id="call_number" name="call_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="192.000..." value="{{ $book->call_number }}">
      @error('call_number')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="title" name="title" class="block mb-2 text-sm font-medium text-gray-900">Title:</label>
      <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Title..." value="{{ $book->title }}">
      @error('title')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="authors" name="authors" class="block mb-2 text-sm font-medium text-gray-900">Authors:</label>
      <input type="text" id="authors" name="authors" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Juan Dela Cruz" value="{{ $book->authors }}">
      @error('authors')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="edition" name="edition" class="block mb-2 text-sm font-medium text-gray-900">Edition:</label>
      <input type="text" id="edition" name="edition" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="1st Edition" value="{{ $book->edition }}">
      @error('edition')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="publication" name="publication" class="block mb-2 text-sm font-medium text-gray-900">Publication:</label>
      <input type="text" id="publication" name="publication" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Manila, Philippines" value="{{ $book->place_of_publication }}">
      @error('publication')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="publisher" name="publisher" class="block mb-2 text-sm font-medium text-gray-900">Publisher:</label>
      <input type="text" id="publisher" name="publisher" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="National Library of the Philippines" value="{{ $book->publisher }}">
      @error('publisher')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="copyright" name="copyright" class="block mb-2 text-sm font-medium text-gray-900">Copyright:</label>
      <input type="text" id="copyright" name="copyright" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="2026" value="{{ $book->copyrights }}">
      @error('copyright')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="cover_image" name="cover_image" class="block mb-2 text-sm font-medium text-gray-900">Cover Image:</label>
      <input class="block w-full text-sm text-gray-600 border border-gray-900 rounded-md cursor-pointer bg-gray-100 focus:outline-none" id="cover_image" name="cover_image" type="file">
      @error('cover_image')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="digital_copy_url" name="digital_copy_url" class="block mb-2 text-sm font-medium text-gray-900">Digital Copy URL:</label>
      <input type="text" id="digital_copy_url" name="digital_copy_url" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="www.example.com">
      @error('digital_copy_url')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="remarks" name="remarks" class="block mb-2 text-sm font-medium text-gray-900">Select Remarks:</label>
      <select id="remarks" name="remarks" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        @if($book->remarks == 'Onshelf')
          <option selected>Onshelf</option>
          <option>Lost</option>
          <option>Missing</option>
        @elseif($book->remarks == 'Lost')
          <option>Onshelf</option>
          <option selected>Lost</option>
          <option>Missing</option>
        @elseif($book->remarks == 'Missing')
          <option>Onshelf</option>
          <option>Lost</option>
          <option selected>Missing</option>
        @endif
      </select>
      @error('remarks')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
  </form>
</div>
@endsection