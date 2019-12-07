@extends("common.layout.print_layout")

@section("container")


    <div class="ui fluid container">

        <div style="display: flex;justify-content: space-between;align-items: flex-start">
            <div class="ui header" style="margin: 0;">شركة نهر الكوفة</div>
            <div class="ui header" style="margin: 0;">كشف حساب مشروع</div>
            <div style="display: flex;align-items: center;flex-direction: column;">
                <div class="ui labeled small input" style="display: flex;align-items: center;">
                    <label class="ui label">من تاريخ</label>
                    <input style="width : 128px;" value="{{request()->route()->parameter("fromDate" , "-")}}" title="" disabled/>
                </div>
                <br/>
                <div class="ui labeled small input" style="display: flex;align-items: center;">
                    <label class="ui label">الى تاريخ</label>
                    <input style="width: 128px;" value="{{request()->route()->parameter("toDate" , "-")}}" title="" disabled/>
                </div>
            </div>
        </div>

        <div class="ui header">
            اسم المشروع : {{$customer->name}}
        </div>

        <table class="ui right aligned celled striped table">
            <thead>
            <tr>
                <th>رقم العملية</th>
                <th>المجموع</th>
                <th>الارادات</th>
                <th>المصاريف</th>
                <th>النوع</th>
                <th>الصنف</th>
                <th>التفاصيل</th>
                <th>التاريخ</th>
            </tr>
            </thead>
            <tbody>
            @php
                $totalDeposit = 0.0;
                $totalWithdraw = 0.0;
                $total = $result && count($result) > 0 ? $result[0]->prevBalance : 0.0;
            @endphp
            @if($result && count($result) > 0)
                <tr>
                    <td></td>
                    <td>{{$result[0]->prevBalance}}</td>
                    <td></td>
                    <td></td>
                    <td>رصيد سابق</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endif
            @foreach($result ? $result : [] as $row)
                @php
                    /** @var array $row */
                    if ($row->type === \App\Models\Action::ACTION_TYPE_DEPOSIT){
                        $totalDeposit += $row->amount;
                        $total += $row->amount;
                    }else if($row->type === \App\Models\Action::ACTION_TYPE_WITHDRAW){
                        $totalWithdraw += $row->amount;
                        $total -= $row->amount;
                    }
                @endphp
                <tr>
                    <td class="center aligned">
                        <a class="ui blue button" style="width: 80px" href="{{route("actions:single" , ["id" => $row->id])}}">
                            {{$row->id}}
                        </a>
                    </td>
                    <td style="background: {{intval($totalDeposit - $totalWithdraw) >= 0 ? "#45D5D4" : "#D8A48F"}}">{{number_format($total)}}</td>
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
                    <td>{{$row->categoryName}}</td>
                    <td class="six wide">{{$row->details}}</td>
                    <td>{{$row->date}}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="background: #EEEEEE;">{{number_format($totalDeposit)}}</td>
                <td style="background: #EEEEEE;">{{number_format($totalWithdraw)}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>

        <div style="" class="ui header">{{$total >= 0 ? "بذمتنا" : "بذمته"}} :
            {{(number_format($total))}}
            <span id="totalAsText" style="padding: 0 40px" data-value="{{$total}}"></span>
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