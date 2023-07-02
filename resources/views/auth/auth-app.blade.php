<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ __('form.system_name') }}</title>
    <link href="{{ asset('css/customs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/coreui-chartjs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/googleapis.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="c-app flex-row align-items-center">
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
