@extends("common.layout.main_layout")


@section("container")
    <form class="ui form" method="post" action="{{route("categories")}}">
        @CSRF
        <div class="ui inline field" style="display: inline-block">
            <label for="name">الاسم</label>
            <input name="name" id="name" placeholder="الاسم">
        </div>
        <button class="ui icon button green">
            <i class="save icon"></i>
            اضافة
        </button>
    </form>

    <div class="ui hidden divider"></div>
    <div class="ui hidden divider"></div>
    <div class="ui hidden divider"></div>

    <table class="ui celled striped table">
        <thead>
        <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>العمليات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>
                    <a class="ui icon yellow button" href="{{route("categories:edit" , ["id" => $category->id])}}">
                        <i class="edit icon"></i>
                    </a>
                    @if(!$category->active)
                        <form method="post" style="display: inline-block;" action="{{route("categories:active")}}">
                            <input hidden title="" name="id" value="{{$category->id}}">
                            <button class="ui icon green button">
                                <i class="lock open icon"></i>
                            </button>
                            @CSRF
                        </form>
                    @else
                        <form method="post" style="display: inline-block;" action="{{route("categories:disable")}}">
                            <input hidden title="" name="id" value="{{$category->id}}">
                            <button class="ui icon red button">
                                <i class="lock icon"></i>
                            </button>
                            @CSRF
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection