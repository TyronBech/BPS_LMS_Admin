<div class="container mx-auto px-2 font-sans flex-col">
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right">
      <thead class="text-xs py-2 text-gray-700 uppercase bg-gray-300 text-center">
        <tr>
          <th scope="col" class="p-2 text-center">RFID</th>
          <th scope="col" class="p-2 text-center">First Name</th>
          <th scope="col" class="p-2 text-center">Middle Name</th>
          <th scope="col" class="p-2 text-center">Last Name</th>
          <th scope="col" class="p-2 text-center">Suffix</th>
          <th scope="col" class="p-2 text-center">Grade</th>
          <th scope="col" class="p-2 text-center">Section</th>
          <th scope="col" class="p-2 text-center">Role</th>
          <th scope="col" class="p-2 text-center">Email</th>
          <th scope="col" class="p-2 text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($students as $item)
        <tr class="bg-white border-b text-center">
          <td scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $item->rfid_tag }}</td>
          <td class="pb-1">{{ $item->first_name }}</td>
          <td class="pb-1">{{ $item->middle_name }}</td>
          <td class="pb-1">{{ $item->last_name }}</td>
          <td class="pb-1">{{ $item->suffix }}</td>
          <td class="pb-1">{{ $item->grade_level }}</td>
          <td class="pb-1">{{ $item->section }}</td>
          <td class="pb-1">{{ $item->role_id == 5 
              ? 'Student' : ($item->role_id == 4 
              ? 'Staff' : ($item->role == 3 
              ? 'Faculty' : ($item->role == 2 
              ? 'Librarian' : 'Admin'))) }}</td>
          <td class="pb-1 px-5">{{ $item->email }}</td>
          <td class="pb-1 flex justify-center">
            <a href="{{ route('maintenance.edit-student', $item->user_id) }}" id="editBtn" name="editBtn" class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 me-2 my-2">Edit</a>
            <a href="{{ route('maintenance.delete-student', $item->user_id) }}" id="deleteBtn" name="deleteBtn" class="focus:outline-none text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 me-2 my-2" onclick="return confirm('Are you sure you want to delete this data?')">Delete</a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="9" class="text-center py-1.5">No data found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>