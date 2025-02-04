<div class="container flex flex-col border-collapse border-2 overflow-x-auto border-slate-900 mt-2 mb-4 rounded-lg bg-white">
  <h2 class="text-center mb-4 mt-4 font-semibold text-2xl">Report Table for Visitors</h2>
  <table class="table-fixed m-4 bg-white">
    <thead id="today-header" class="bg-blue-400 text-left font-bold text-slate-200">
      <th class="text-center">Log ID</th>
      <th class="text-center">Email</th>
      <th>Name</th>
      <th>Middle Name</th>
      <th>Surname</th>
      <th>Date</th>
      <th>Time</th>
      <th>Action</th>
    </thead>
    <tbody id="students-activity">
      @forelse($data as $item)
        <tr>
          <td class="pb-1 text-center">{{ $item->log_id }}</td>
          <td class="pb-1 text-center">{{ $item->email }}</td>
          <td class="pb-1">{{ $item->first_name }}</td>
          <td class="pb-1">{{ $item->middle_name }}</td>
          <td class="pb-1">{{ $item->last_name }}</td>
          <td class="pb-1">{{ $item->log_date }}</td>
          <td class="pb-1">{{ $item->log_time }}</td>
          <td class="pb-1">{{ $item->actiontype }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="8" class="text-center">No data found.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>