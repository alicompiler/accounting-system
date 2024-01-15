<div id="sidebar-menu" class="sidebar-menu">

    <div class="header">
        <span class="user-name">
            {{request()->get('user')->name}}
        </span>
    </div>

    <div class="content">

        <div class="box">
            <b>مرحبا</b>
        </div>

        <div class="items">

            <a href="{{route("customers")}}" class="item">المشاريع</a>
            {{--<a href="{{route("categories")}}" class="item">التصنيفات</a>--}}
            <a href="{{route("actions:create")}}" class="item">تسجيل عملية</a>
            <a href="{{route("report:customer")}}" class="item">تقرير عن مشروع</a>
            <a href="{{route("report:action")}}" class="item">تقرير عن عمليات</a>
            <a href="{{route("report:all-customers")}}" class="item">تقرير عن كل المشاريع</a>

        </div>

    </div>

</div>