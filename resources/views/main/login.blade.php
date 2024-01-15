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

    <title>اسم النظام</title>
</head>
<body>

@yield('before-container')


<div style="display: flex;align-items: center;justify-content: center;height: 100vh;width:100%;">
    <form class="ui form large login" action="{{route('login')}}" method="post">

        @if ($errors->any())
            <div class="ui negative message">
                <div class="content">{{$errors->all()[0]}}</div>
            </div>
        @endif

        @CSRF
        <div class="field">
            <label id="username">اسم المستخدم</label>
            <input class="full-width-mobile" name="username" id="username" type="text" placeholder="اسم المستخدم">
        </div>

        <div class="field">
            <label id="password">كلمة المرور</label>
            <input class="full-width-mobile" name="password" id="password" type="password" placeholder="كلمة المرور">
        </div>

        <button class="ui blue button fluid">
            تسجيل الدخول
        </button>
    </form>
</div>

@yield('after-container')

</body>

<script>
    $(".ui.dropdown").dropdown();
</script>


@yield("page_script")

</html>