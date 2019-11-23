@extends("common.layout.main_layout")

@section("container")

    <div class="ui large header">ايقاف مشروع</div>
    <div class="ui divider"></div>


    <div class="ui grid">
        <div class="eight wide column">
            <form class="ui form" method="post" action="{{route("customers:disable@presist")}}">

                <div class="ui large header">
                    هل انت متاكد من ايقاف المشروع :
                    {{$customer->name}}
                </div>

                <input hidden title="" value="{{$customer->id}}" name="id">

                <button class="ui large green icon button">
                    <i class="save icon"></i>
                    ايقاف
                </button>

                @CSRF
            </form>
        </div>
        <div class="eight wide column"></div>
    </div>

@endsection