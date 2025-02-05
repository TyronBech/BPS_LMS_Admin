<div class="container flex flex-col border-collapse overflow-x-auto border-2 border-slate-900 mt-2 mb-4 rounded-lg bg-white">
  <h2 class="text-center mb-2 mt-4 font-semibold text-2xl">Spreadsheet Contents</h2>
  <table class="table-fixed m-4 bg-white">
    <thead class="bg-blue-400 font-bold text-slate-200">
      <tr>
        <th>LRN</th>
        <th>Employee ID</th>
        <th>RFID</th>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last Name</th>
        <th>Suffix</th>
        <th>Grade</th>
        <th>Section</th>
        <th>Role</th>
        <th>Email</th>
        <th>Profile</th>
        <th>Password</th>
      </tr>
    </thead>
    <tbody class="text-center">
      @forelse($data as $item)
        <tr>
          <td>{{ $item['lrn'] }}</td>
          <td>{{ $item['employee_id'] }}</td>
          <td>{{ $item['rfid'] }}</td>
          <td>{{ $item['first_name'] }}</td>
          <td>{{ $item['middle_name'] }}</td>
          <td>{{ $item['last_name'] }}</td>
          <td>{{ $item['suffix'] }}</td>
          <td>{{ $item['grade_level'] }}</td>
          <td>{{ $item['section'] }}</td>
          <td>{{ $item['role_id'] }}</td>
          <td>{{ $item['email'] }}</td>
          <td>{{ $item['profile_image'] }}</td>
          <td>{{ $item['password'] }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="13">No data found.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>