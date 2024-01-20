<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @if(isset($viewport) && $viewport == false)
        <!-- no view port -->
    @else
        <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    @endif

    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="stylesheet" href="{{url('/res/semantic.min.css')}}">
    <link rel="stylesheet" href="{{url('/res/animate.min.css')}}">
    <script src="{{url('/res/jquery-3.4.1.min.js')}}"></script>
    <script src="{{url('/res/semantic.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('/res/app.css')}}">
    <link rel="stylesheet" href="{{url('/res/ar_fix.css')}}">

    <script src="{{url('/res/app.js')}}"></script>
    <script src="{{url('/res/notifications.js')}}"></script>

    <title>شركة افاق السنا</title>
</head>
<body>

@yield('before-container')

<div id="app">
    @include('common.layout.sidebar')

    <div class="pusher app-container">
        @include('common.layout.header')

        <div class="mobile-menu" id="mobile-menu">
       
                <div class="mobile-menu-items">

                    <span class="user-name">
                        {{request()->get('user')->name}}
                    </span>

                    <a href="{{route("customers")}}" class="item">المشاريع</a>
                    <a href="{{route("actions:create")}}" class="item">تسجيل عملية</a>
                    <a href="{{route("report:customer")}}" class="item">تقرير عن مشروع</a>
                    <a href="{{route("report:action")}}" class="item">تقرير عن عمليات</a>
                    <a href="{{route("report:all-customers")}}" class="item">تقرير عن كل المشاريع</a>
                    <a id='backup-button-mobile' href="{{route('backup')}}" class="item">Backup</a>
                    <a class="close-button" onclick="toggleMobileMenu();">اخفاء</a>

                </div>

        </div>

        <div style="padding: 16px;" class="ui container">
            @yield('container')
        </div>

    </div>
</div>

@yield('after-container')

</body>

<script>
    $(".ui.dropdown").dropdown();

    document.addEventListener("DOMContentLoaded", function () {
        const backupButton = document.getElementById('backup-button-mobile');
        backupButton.addEventListener('click', function (e) {
            if (!confirm('هل تريد عمل نسخة احتياطية من البيانات؟')) {
                e.preventDefault();
            }
        });
    });
</script>


@yield("page_script")

</html>