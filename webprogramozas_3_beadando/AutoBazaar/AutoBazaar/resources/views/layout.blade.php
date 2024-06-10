<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'AutoBazaar')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="icon" href="{{ asset('car_icon2.ico') }}" type="image/x-icon"/>
  </head>
  <body>
    @include('include.header')
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<style>
  body {
    background-color: #f5f5f5;
}


a {
    color: #8DB600;
}

a:hover {
    text-decoration: underline;
}
</style>