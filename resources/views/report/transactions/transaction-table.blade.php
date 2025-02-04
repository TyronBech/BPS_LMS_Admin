<div class="container flex flex-col border-collapse overflow-x-auto border-2 border-slate-900 mt-2 mb-4 rounded-lg bg-white">
  <h2 class="text-center mb-4 mt-4 font-semibold text-2xl">Transaction Table</h2>
  <table class="table-fixed m-4 bg-white">
    <thead id="today-header" class="bg-blue-400 font-bold text-slate-200">
      <th>Copy ID</th>
      <th>User ID</th>
      <th>Last Name</th>
      <th>First Name</th>
      <th>Transaction</th>
      <th>Borrowed</th>
      <th>Due</th>
      <th>Returned</th>
    </thead>
    <tbody id="students-activity" class="text-center">
      @forelse($data as $item)
        <tr>
          <td class="pb-1">{{ $item->copy_id }}</td>
          <td class="pb-1">{{ $item->user_id }}</td>
          <td class="pb-1">{{ $item->last_name }}</td>
          <td class="pb-1">{{ $item->first_name }}</td>
          @if($item->transaction_type == 'borrow')
            <td class="text-red-600 pb-1">{{ $item->transaction_type }}</td>
          @elseif($item->transaction_type == 'return')
            <td class="text-green-600 pb-1">{{ $item->transaction_type }}</td>
          @endif
          <td class="pb-1">{{ $item->date_borrowed }}</td>
          <td class="pb-1">{{ $item->due_date }}</td>
          <td class="pb-1">{{ $item->return_date }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="8">No data found.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>