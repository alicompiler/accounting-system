@extends("common.layout.main_layout")


@section("container")

    <div class="app-form">
        <form class="ui form" action="{{route("actions:create@presist")}}" method="post" enctype="multipart/form-data">

            <div class="field">
                <label for="customer_id">المشروع</label>
                <select required name="customer_id" id="customer_id" class="ui search dropdown full-width-mobile">
                    <option value="">المشروع</option>
                    @foreach ($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label for="category_id">صنف العملية</label>
                <select name="category_id" id="category_id" class="ui search dropdown full-width-mobile">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label for="type">نوع العملية</label>
                <select required name="type" id="type" class="ui selection dropdown full-width-mobile">
                    <option value="{{\App\Models\Action::ACTION_TYPE_WITHDRAW}}">صرف</option>
                    <option value="{{\App\Models\Action::ACTION_TYPE_DEPOSIT}}">قبض</option>
                </select>
            </div>

            <div class="field">
                <label for="amount">المبلغ : <span style="margin: 0 16px" id="amountLabel"></span></label>
                <input class="full-width-mobile" required autocomplete="off" type="number" id="amount" name="amount" placeholder="المبلغ">
                <label style="display : none;" id="amountWordsLabel"></label>
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
                <textarea class="full-width-mobile" required id="details" name="details" placeholder="التفاصيل"></textarea>
            </div>

            <div class="field">
                <label for="date">التاريخ</label>
                <input class="full-width-mobile" required autocomplete="off" name="date" value="{{date('Y-m-d')}}" id="date" placeholder="التاريخ" type="date">
            </div>

            <div class="field">
                <label for="files">المرفقات</label>
                <input class="full-width-mobile" autocomplete="off" multiple name="files[]" id="files" placeholder="المرفقات" type="file">
            </div>

            <button class="ui icon large green button">
                <i class="save icon"></i>
                حفظ
            </button>
            @CSRF
        </form>
    </div>
@endsection
