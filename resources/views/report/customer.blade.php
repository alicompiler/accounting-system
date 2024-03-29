@extends("common.layout.main_layout")

@section('container')
    <div>
        <form class="ui form">

            <div style="display: inline-flex;align-items: flex-end;">

                <div class="fields" style="display: inline-flex;margin: 0;">
                    <div class="field">
                        <label for="customer_id">المشروع</label>
                        <select required name="customer_id" id="customer_id" class="ui search dropdown">
                            <option value="">المشروع</option>
                            @foreach ($customers as $customer)
                                <option {{request()->query("customer_id") == $customer->id ? "selected": ""}} value="{{$customer->id}}">{{$customer->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="field">
                        <label for="fromDate">من تاريخ</label>
                        <input id="fromDate" type="date" name="fromDate" value="{{request()->query("fromDate" , date('Y-m-d'))}}"
                               placeholder="من تاريخ"/>
                    </div>
                    <div class="field">
                        <label for="toDate">الي تاريخ</label>
                        <input id="toDate" type="date" name="toDate" value="{{request()->query("toDate",date('Y-m-d'))}}"
                               placeholder="الي تاريخ"/>
                    </div>
                </div>


                <button class="ui large blue button">
                    ابحث
                </button>

            </div>

        </form>
    </div>

    <br/><br/><br/>

    <div>

        <table class="ui right aligned celled striped table">
            <thead>
            <tr>
                <th>رقم العملية</th>
                <th>المجموع</th>
                <th>الايرادات</th>
                <th>المصاريف</th>
                <th>النوع</th>
                <th>التفاصيل</th>
                <th>التاريخ</th>
            </tr>
            </thead>
            <tbody>
            @foreach($result ? $result : [] as $row)
                <tr>
                    <td class="center aligned">
                        <a class="ui blue button" style="width: 80px" href="{{route("actions:single" , ["id" => $row->id])}}">
                            {{$row->id}}
                        </a>
                    </td>
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
            </tbody>
        </table>

        @if ($result === null)
        @elseif (count($result) == 0)
            <div class="ui info center aligned message">
                <div style="text-align: center;" class="header">لا توجد نتائج</div>
            </div>
        @elseif (count($result) > 0)
            <div>
                <div class="ui segment small header">الايرادات :
                    {{number_format($result[count($result)-1]->totalDeposit)}}
                </div>
                <div class="ui segment small header">المصروفات :
                    {{number_format($result[count($result)-1]->totalWithdraw)}}
                </div>

                <div class="ui segment small header">{{$result[count($result)-1]->total >= 0 ? "بذمتنا" : "بذمته"}} :
                    {{number_format(abs($result[count($result)-1]->total))}}
                </div>
            </div>

            <br/>
            <a href="{{route("print:customer" , ["fromDate" => request()->query("fromDate") ,
                "toDate" => request()->query("toDate"),
                "customer_id" => request()->query("customer_id")
            ])}}"
               target="_blank" class="ui blue button">طباعة</a>
        @endif
    </div>

@stop