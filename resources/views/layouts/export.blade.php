<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title','ប្រព័ន្ធគ្រប់គ្រងប្រាក់សន្សំ')</title>
    <link href="{{ asset('css/customs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/print.css') }}" rel="stylesheet" type="text/css">    
    <link href="{{ asset('css/googleapis.css') }}" rel="stylesheet" type="text/css">    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css')
</head>

 <body >
     @yield('content')
     <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  </body>
</html>
