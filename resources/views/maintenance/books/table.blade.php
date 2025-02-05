<div class="mx-auto px-2 font-sans flex-col">
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right">
      <thead class="text-xs py-2 text-gray-700 uppercase bg-gray-300 text-center">
        <tr>
          <th scope="col" class="p-2 text-center">Accession</th>
          <th scope="col" class="p-2 text-center">Call Number</th>
          <th scope="col" class="p-2 text-center">Title</th>
          <th scope="col" class="p-2 text-center">Authors</th>
          <th scope="col" class="p-2 text-center">Edition</th>
          <th scope="col" class="p-2 text-center">Publication</th>
          <th scope="col" class="p-2 text-center">Publisher</th>
          <th scope="col" class="p-2 text-center">Copyright</th>
          <th scope="col" class="p-2 text-center">Remarks</th>
          <th scope="col" class="p-2 text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($books as $item)
        <tr class="bg-white border-b text-center">
          <td class="pl-2">{{ $item->accession }}</td>
          <td class="pl-2">{{ $item->call_number }}</td>
          <td class="max-w-sm">{{ $item->title }}</td>
          <td class="max-w-xs">{{ $item->authors }}</td>
          <td>{{ $item->edition }}</td>
          <td>{{ $item->place_of_publication }}</td>
          <td>{{ $item->publisher }}</td>
          <td>{{ $item->copyrights }}</td>
          <td>{{ $item->remarks }}</td>
          <td class="pb-1 flex justify-center">
            <a href="{{ route('maintenance.edit-book', $item->accession) }}" id="editBtn" name="editBtn" class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 me-2 my-2">Edit</a>
            <a href="{{ route('maintenance.delete-book', $item->book_id) }}" id="deleteBtn" name="deleteBtn" class="focus:outline-none text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 me-2 my-2" onclick="return confirm('Are you sure you want to delete this data?')">Delete</a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="10" class="text-center py-1.5">No data found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>