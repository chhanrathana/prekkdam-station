<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>រកមិនឃើញទំព័រ.</title>
    <link rel="stylesheet" href="{{ asset('css/error.css') }}">
</head>
<body>
<div class="content">
    <canvas class="snow" id="snow"></canvas>
    <div class="main-text">
        <h5>រកមិនឃើញ.!<br/>NOT FOUND.!</h5>
    </div>
    <div class="ground">
        <div class="mound">
            <div class="mound_text">404</div>
            <div class="mound_spade"></div>
        </div>
    </div>
</div>
<script src="{{ asset('js/error.js') }}"></script>
</body>
</html>
