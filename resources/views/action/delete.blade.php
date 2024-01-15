@extends("common.layout.main_layout")

@section("container")

    <div class="ui large header">حذف عملية</div>
    <div class="ui divider"></div>


    @include("action.display_action" , ["action" => $action])

    <br/>
    <form class="ui form" method="post" action="{{route("actions:delete@presist")}}">

        <input hidden title="" value="{{$action->id}}" name="id">
        <button class="ui large red icon button">
            <i class="save icon"></i>
            حذف
        </button>

        @CSRF
        @METHOD("DELETE")
    </form>

@endsection