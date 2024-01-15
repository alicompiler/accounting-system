@extends("common.layout.main_layout")

@section("container")

    <div class="ui large header">تعديل مشروع</div>
    <div class="ui divider"></div>


    <div class="app-form">
        <form class="ui form" method="post" action="{{route("customers")}}">

            <input hidden name="id" value="{{$customer->id}}" title="">

            <div class="field">
                <label for="name">الاسم</label>
                <input required autocomplete="off" id="name" name="name" value="{{$customer->name}}" placeholder="الاسم">
            </div>

            <div class="field">
                <label for="phone">الهاتف</label>
                <input required autocomplete="off" id="phone" name="phone" value="{{$customer->phone}}" placeholder="الهاتف">
            </div>

            <div class="field">
                <label for="address">العنوان</label>
                <input required autocomplete="off" id="address" name="address" value="{{$customer->address}}" placeholder="العنوان">
            </div>

            <div class="field">
                <label for="">الرصيد</label>
                <input required autocomplete="off" type="number" id="balance" name="balance" value="{{$customer->balance()}}" placeholder="الرصيد">
            </div>


            <button class="ui large green icon button">
                <i class="save icon"></i>
                تعديل
            </button>

            @CSRF @METHOD("PUT")
        </form>
    </div>

@endsection
