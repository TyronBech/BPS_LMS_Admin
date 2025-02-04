<div class="container flex flex-col overflow-x-auto border-collapse border-2 border-slate-900 mt-2 mb-4 rounded-lg bg-white">
  <h2 class="text-center mb-4 mt-4 font-semibold text-2xl">Book Circulation Table</h2>
  <table class="table-fixed m-4 bg-white">
    <thead id="today-header" class="bg-blue-400 font-bold text-slate-200">
      <th>Book ID</th>
      <th>Copy ID</th>
      <th>Title</th>
      <th>Barcode</th>
      <th>Availability</th>
      <th>Condition</th>
    </thead>
    <tbody id="students-activity" class="text-center">
      @forelse($data as $item)
        <tr>
          <td class="pb-1">{{ $item->book_id }}</td>
          <td class="pb-1">{{ $item->id }}</td>
          <td class="pb-1">{{ $item->title }}</td>
          <td class="pb-1">{{ $item->barcode }}</td>
          @if($item->availability_status == 'available')
            <td class="pb-1 text-green-500">{{ $item->availability_status }}</td>
          @elseif($item->availability_status == 'borrowed')
            <td class="pb-1 text-red-500">{{ $item->availability_status }}</td>
          @elseif($item->availability_status == 'reserved')
            <td class="pb-1 text-yellow-500">{{ $item->availability_status }}</td>
          @endif
          @if($item->condition_status == 'new')
            <td class="pb-1 text-blue-500">{{ $item->condition_status }}</td>
          @elseif($item->condition_status == 'good')
            <td class="pb-1 text-green-500">{{ $item->condition_status }}</td>
          @elseif($item->condition_status == 'fair')
            <td class="pb-1 text-yellow-500">{{ $item->condition_status }}</td>
          @elseif($item->condition_status == 'poor')
            <td class="pb-1 text-red-500">{{ $item->condition_status }}</td>
          @endif
        </tr>
      @empty
        <tr>
          <td colspan="6">No data found.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>