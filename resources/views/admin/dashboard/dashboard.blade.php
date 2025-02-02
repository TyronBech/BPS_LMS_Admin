<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Document</title>
</head>
<body>
  <h1 class="text-center text-2xl font-bold">Dashboard Success</h1>
  <form action="{{ route('admin.logout') }}" class="form-control" method="POST">
    @csrf
    <button type="submit" class="bg-red-500">Logout</button>
  </form>
</body>
</html>