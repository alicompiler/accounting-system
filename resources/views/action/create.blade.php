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
                    <label for="type">نوع العملية</label>
                    <select required name="type" id="type" class="ui selection dropdown">
                        <option value="{{\App\Models\Action::ACTION_TYPE_DEPOSIT}}">قبض</option>
                        <option value="{{\App\Models\Action::ACTION_TYPE_WITHDRAW}}">صرف</option>
                    </select>
                </div>

                <div class="field">
                    <label for="amount">المبلغ : <span style="margin: 0 16px" id="amountLabel"></span></label>
                    <input autocomplete="off" type="number" id="amount" name="amount" placeholder="المبلغ">
                    <label id="amountWordsLabel"></label>
                    <script>
                        document.getElementById("amount").onkeyup = function () {
                            let amount = document.getElementById('amount').value;
                            amount = amount ? amount : 0;
                            document.getElementById('amountLabel').innerText = formatCurrency(amount);
                            document.getElementById("amountWordsLabel").innerText = new NumberToWords(parseInt(amount)).parse();
                        }
                    </script>
                </div>


                <div class="field">
                    <label for="details">التفاصيل</label>
                    <textarea id="details" name="details" placeholder="التفاصيل"></textarea>
                </div>

                <div class="field">
                    <label for="date">التاريخ</label>
                    <input autocomplete="off" name="date" value="{{date('Y-m-d')}}" id="date" placeholder="التاريخ" type="date">
                </div>

                {{--<div class="field">--}}
                {{--<label for="category_id">التصنيف</label>--}}
                {{--<select required name="category_id" id="category_id" class="ui search dropdown">--}}
                {{--<option value="">التصنيف</option>--}}
                {{--@foreach ($categories as $category)--}}
                {{--<option value="{{$category->id}}">{{$category->name}}</option>--}}
                {{--@endforeach--}}
                {{--</select>--}}
                {{--</div>--}}


                <button class="ui icon large green button">
                    <i class="save icon"></i>
                    حفظ
                </button>
                @CSRF
            </form>
        </div>
        <div class="eight wide column"></div>
    </div>
@endsection