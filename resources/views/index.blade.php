<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
  <x-sidebar :username="Auth::user()->username" />
  <h1 class="text-3xl text-center font-bold underline">
    Hello world!
  </h1>
</body>
</html>