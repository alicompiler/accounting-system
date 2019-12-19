@extends("common.layout.main_layout")

@section("container")

    <div class="ui large header">اضافة مشروع جديد</div>
    <div class="ui divider"></div>


    <div class="ui grid">
        <div class="eight wide column">
            <form class="ui form" method="post" action="{{route("customers")}}">

                <div class="field">
                    <label for="name">الاسم</label>
                    <input required autocomplete="off" id="name" name="name" placeholder="الاسم">
                </div>

                <div class="field">
                    <label for="phone">الهاتف</label>
                    <input required autocomplete="off" id="phone" name="phone" placeholder="الهاتف">
                </div>

                <div class="field">
                    <label for="address">العنوان</label>
                    <input required autocomplete="off" id="address" name="address" placeholder="العنوان">
                </div>

                <input hidden required autocomplete="off"
                       title="" type="number" id="balance" name="balance" placeholder="الرصيد الابتدائي"
                       value="0">


                <button class="ui large green icon button">
                    <i class="save icon"></i>
                    اضافة
                </button>

                @CSRF
            </form>
        </div>
        <div class="eight wide column"></div>
    </div>

@endsection