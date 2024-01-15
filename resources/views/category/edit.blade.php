@extends("common.layout.main_layout")

@section("container")

    <div class="ui large header">تعديل تصنيف</div>
    <div class="ui divider"></div>


    <div class="ui grid">
        <div class="eight wide column">
            <form class="ui form" method="post" action="{{route("categories")}}">

                <input hidden name="id" value="{{$category->id}}" title="">

                <div class="field">
                    <label for="name">الاسم</label>
                    <input required autocomplete="off" id="name" name="name" value="{{$category->name}}" placeholder="الاسم">
                </div>


                <button class="ui large green icon button">
                    <i class="save icon"></i>
                    تعديل
                </button>

                @CSRF @METHOD("PUT")
            </form>
        </div>
        <div class="eight wide column"></div>
    </div>

@endsection