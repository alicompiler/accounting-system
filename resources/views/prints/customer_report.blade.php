@extends("common.layout.print_layout")

@section("container")

    <style>

        .ui.celled.table tr th, .ui.celled.table tr td {
            border: 1px solid #000 !important;
        }

        .ui.labeled.small.input {
            border: #111 solid 1px;
        }

        .ui.labeled.small.input label {
            background: none;
        }


    </style>


    <div class="ui fluid container">

        <div style="display: flex;justify-content: space-between;align-items: flex-start">
            <div>
                <div class="ui header" style="margin: 0;">شركة نهر الكوفة</div>
                <div class="ui header">
                    اسم المشروع : {{$customer->name}}
                </div>
            </div>
            <div class="ui header" style="margin: 0;">كشف حساب مشروع</div>
            <div style="display: flex;align-items: center;flex-direction: column;">
                <div class="ui labeled small input" style="display: flex;align-items: center;">
                    <label class="ui label">من تاريخ</label>
                    <input style="width : 128px;" value="{{request()->query("fromDate" , "-")}}" title="" disabled/>
                </div>
                <br/>
                <div class="ui labeled small input" style="display: flex;align-items: center;">
                    <label class="ui label">الى تاريخ</label>
                    <input style="width: 128px;" value="{{request()->query("toDate" , "-")}}" title="" disabled/>
                </div>
            </div>
        </div>


        <table class="ui right aligned celled striped table">
            <thead>
            <tr>
                <th>رقم العملية</th>
                <th>المجموع</th>
                <th>الارادات</th>
                <th>المصاريف</th>
                <th>النوع</th>
                <th>التفاصيل</th>
                <th>التاريخ</th>
            </tr>
            </thead>
            <tbody>
            @foreach($result ? $result : [] as $row)
                <tr>
                    <td class="center aligned">{{$row->id}}</td>
                    <td style="background: {{$row->total >= 0 ? "#45D5D4" : "#D8A48F"}}">{{number_format($row->total)}}</td>
                    <td style="">
                        @if ($row->type === \App\Models\Action::ACTION_TYPE_DEPOSIT)
                            {{number_format($row->amount)}}
                        @endif
                    </td>
                    <td style="">
                        @if ($row->type === \App\Models\Action::ACTION_TYPE_WITHDRAW)
                            {{number_format($row->amount)}}
                        @endif
                    </td>
                    <td>{{$row->type == \App\Models\Action::ACTION_TYPE_DEPOSIT ? "قبض" : "صرف"}}</td>
                    <td class="six wide">{{$row->details}}</td>
                    <td>{{$row->date}}</td>
                </tr>
            @endforeach
            @if($result && count($result) > 0)
                <tr>
                    <td></td>
                    <td></td>
                    <td style="background: #DDD">{{number_format($result[count($result)-1]->totalDeposit)}}</td>
                    <td style="background: #DDD">{{number_format($result[count($result)-1]->totalWithdraw)}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endif
            </tbody>
        </table>


        @if($result && count($result) > 0)
            <div style="" class="ui header">{{$result[count($result)-1]->total >= 0 ? "بذمتنا" : "بذمته"}} :
                {{number_format(abs($result[count($result)-1]->total))}}
                <span id="totalAsText" style="padding: 0 40px" data-value="{{abs($result[count($result)-1]->total)}}"></span>
            </div>
        @endif

        <div class="ui medium left aligned header">
            شركة نهر الكوفة للمقاولات العامة المحدودة
        </div>

        <script>
            const totalAsTextElement = document.getElementById("totalAsText");
            const value = totalAsTextElement.getAttribute("data-value");
            const text = new NumberToWords(value).parse();
            totalAsTextElement.innerText = text;
        </script>

    </div>

    <script>
        window.print();
    </script>
@endsection