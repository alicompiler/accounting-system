@extends("common.layout.main_layout")


@section("container")

    <div class="ui grid">
        <div class="eight wide column">
            <form class="ui form" action="{{route("actions:create@presist")}}" method="post">

                <div class="field">
                    <label for="customer_id">المشروع</label>
                    <select required name="customer_id" id="customer_id" class="ui search dropdown">
                        <option value="">المشروع</option>
                        @foreach ($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label for="amount">المبلغ</label>
                    <input id="amount" name="amount" placeholder="المبلغ">
                </div>

                <div class="field">
                    <label for="type">نوع العملية</label>
                    <select required name="type" id="type" class="ui selection dropdown">
                        <option value="{{\App\Models\Action::ACTION_TYPE_DEPOSIT}}">قبض</option>
                        <option value="{{\App\Models\Action::ACTION_TYPE_WITHDRAW}}">صرف</option>
                    </select>
                </div>

                <div class="field">
                    <label for="details">التفاصيل</label>
                    <textarea id="details" name="details" placeholder="التفاصيل"></textarea>
                </div>

                <div class="field">
                    <label for="date">التاريخ</label>
                    <input name="date" id="date" placeholder="التاريخ" type="date">
                </div>

                <div class="field">
                    <label for="category_id">التصنيف</label>
                    <select required name="category_id" id="category_id" class="ui search dropdown">
                        <option value="">التصنيف</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>


                <button class="ui large green button">
                    <i class="save icon"></i>
                    حفظ
                </button>
                @CSRF
            </form>
        </div>
        <div class="eight wide column"></div>
    </div>
@endsection