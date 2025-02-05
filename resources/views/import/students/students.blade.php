@extends('layouts.admin-app')
@section('content')
<h4 class="text-2xl font-semibold mt-3 text-center">Student Data</h4>
<p class="mt-1 text-md/relaxed text-center">Import student data to be used in the application using the CSV or Excel format</p>
<p class="mt-1 text-sm/relaxed text-slate-500 text-center">ex. newly enrolled students or transferred students can be imported.</p>
@if(!$showTable)
<div class="border-2 border-slate-700 rounded-lg flex flex-col text-center items-center mb-4 mt-2 w-full">
  <form action="{{ route('import.upload-students') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label class="block mt-4 text-sm font-medium text-gray-600 for=" file_input">Upload a file in CSV or Excel format</label>
    <input class="block w-full text-sm text-gray-600 border border-gray-900 rounded-md cursor-pointer bg-gray-100 focus:outline-none" id="file_input" name="file" type="file">
    <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-2 focus:ring-green-300 font-medium rounded-lg text-md px-4 py-2 me-2 mb-2 mt-4">Import</button>
  </form>
</div>
@else
@include('import.students.table')
<form action="{{ route('import.store-students') }}" method="POST" class="flex justify-center">
  @csrf
  <input type="hidden" name="data" value="{{ json_encode($data) }}">
  <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-2 focus:ring-green-300 font-medium rounded-lg text-md px-4 py-2 me-2 mb-2 mt-4">Insert to Database</button>
</form>
@endif
@endsection
@section('scripts')
@endsection