<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="stylesheet" href="{{url('/res/semantic.min.css')}}">
    <link rel="stylesheet" href="{{url('/res/animate.min.css')}}">
    <script src="{{url('/res/jquery-3.4.1.min.js')}}"></script>
    <script src="{{url('/res/semantic.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('/res/app.css')}}">
    <link rel="stylesheet" href="{{url('/res/ar_fix.css')}}">

    <script src="{{url('/res/app.js')}}"></script>
    <script src="{{url('/res/notifications.js')}}"></script>

    <title>_</title>
</head>
<body>

@yield('before-container')

<div id="app" style="padding : 16px">
    @yield('container')
</div>

@yield('after-container')

</body>

<script>
    $(".ui.dropdown").dropdown();
</script>


@yield("page_script")

</html>