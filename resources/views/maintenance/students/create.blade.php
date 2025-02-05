@extends('layouts.admin-app')
@section('content')
<h1 class="font-semibold text-center text-4xl p-5">Maintenance</h1>
<div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
  <div class="flex justify-between">
    <h5 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">Add User</h5>
    <a href="{{ route('maintenance.students') }}" class="inline-flex items-center px-3 py-1 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
      Back
      <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
      </svg>
    </a>
  </div>
  <hr class="h-px my-3 bg-gray-200 border-0">
  <form action="{{ route('maintenance.store-student') }}" class="max-w-2xl mx-auto" method="POST">
    @csrf
    <h6 class="mb-1 text-xl font-semibold tracking-tight text-gray-800">User Information</h6>
    <div class="mb-5">
      <label for="lrn" name="lrn" class="block mb-2 text-sm font-medium text-gray-900">LRN Number:</label>
      <input type="text" id="lrn" name="lrn" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="0123456789">
      @error('lrn')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="rfid" name="rfid" class="block mb-2 text-sm font-medium text-gray-900">RFID Number:</label>
      <input type="text" id="rfid" name="rfid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="0123456789">
      @error('rfid')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="employeeID" name="employeeID" class="block mb-2 text-sm font-medium text-gray-900">Employee ID:</label>
      <input type="text" id="employeeID" name="employeeID" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="0123456789">
      @error('employeeID')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="first-name" name="first-name" class="block mb-2 text-sm font-medium text-gray-900">First Name:</label>
      <input type="text" id="first-name" name="first-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Juan">
      @error('first-name')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="middle-name" name="middle-name" class="block mb-2 text-sm font-medium text-gray-900">Middle Name:</label>
      <input type="text" id="middle-name" name="middle-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Santos">
      @error('middle-name')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="last-name" name="last-name" class="block mb-2 text-sm font-medium text-gray-900">Last Name:</label>
      <input type="text" id="last-name" name="last-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Dela Cruz">
      @error('last-name')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="suffix" name="suffix" class="block mb-2 text-sm font-medium text-gray-900">Suffix:</label>
      <input type="text" id="suffix" name="suffix" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Jr.">
      @error('suffix')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="grade" name="grade" class="block mb-2 text-sm font-medium text-gray-900">Grade:</label>
      <input type="text" id="grade" name="grade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="12">
      @error('grade')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="section" name="section" class="block mb-2 text-sm font-medium text-gray-900">Section:</label>
      <input type="text" id="section" name="section" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="A">
      @error('section')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="role" name="role" class="block mb-2 text-sm font-medium text-gray-900">Select Role:</label>
      <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        <option>Student</option>
        <option>Faculty</option>
        <option>Admin</option>
        <option>Staff</option>
        <option>Librarian</option>
      </select>
      @error('role')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="profile-image" name="profile-image" class="block mb-2 text-sm font-medium text-gray-900">Cover Image:</label>
      <input class="block w-full text-sm text-gray-600 border border-gray-900 rounded-md cursor-pointer bg-gray-100 focus:outline-none" id="profile-image" name="profile-image" type="file">
      @error('profile-image')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="email-address-icon" class="block mb-2 text-sm font-medium text-gray-900">Email Address:</label>
      <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
            <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
            <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
          </svg>
        </div>
        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="juandelacruz@gmail.com">
      </div>
      @error('email')
      <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{ $message }}</span>
      </div>
      @enderror
    </div>
    <div class="mb-5">
      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
      <input type="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
    </div>
    @error('password')
    <div class="p-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
      <span class="font-medium">{{ $message }}</span>
    </div>
    @enderror
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
  </form>
</div>
@endsection