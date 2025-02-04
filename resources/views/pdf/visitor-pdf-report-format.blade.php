<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <style>
    html, body, h1, h4{
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }
    h1{
      text-align: center;
      font-size: 30px;
      font-family: sans-serif;
      width: 100%;
    }
    .page-break {
      page-break-after: always;
    }
    h4{
      text-align: center;
      font-size: 20px;
      font-family: sans-serif;
      width: 100%;
    }
    table{
      overflow: hidden;
      width: 100%;
      border: 3px solid rgb(47, 47, 47);
      border-collapse: collapse;
    }
    thead, tbody{
      padding: 0 10px;
    }
    th, td{
      padding: 7px 10px;
      font-size: 12px;
    }
    tr:nth-child(odd){
      background-color: aliceblue;
    }
    .table-border{
      margin: 20px 0;
    }
  </style>
  <title>Report Document</title>
</head>
<body>
  <h1>Report Document for Visitors</h1>
  <h4><?php echo date('F d, Y'); ?></h4>
  <div class="table-border">
    @foreach($data as $items)
      <table class="{{ !$loop->last ? 'page-break' : ''}}">
        <thead>
          <tr>
            <th>Log ID</th>
            <th>Email</th>
            <th>Name</th>
            <th>Middle Name</th>
            <th>Surname</th>
            <th>Date</th>
            <th>Time In</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($items as $item)
            <tr>
              <td>{{ $item->log_id }}</td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->first_name }}</td>
              <td>{{ $item->middle_name }}</td>
              <td>{{ $item->last_name }}</td>
              <td>{{ $item->log_date }}</td>
              <td>{{ $item->log_time }}</td>
              <td>{{ $item->actiontype }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="8">No data found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    @endforeach
  </div>
</body>
</html>