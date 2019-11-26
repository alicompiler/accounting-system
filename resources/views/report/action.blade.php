@extends("common.layout.main_layout")

@section('container')
    <div>
        <form class="ui form">

            <div style="display: inline-flex;align-items: flex-end;">

                <div class="fields" style="display: inline-flex;margin: 0;">

                    <div class="field">
                        <label for="fromDate">من تاريخ</label>
                        <input id="fromDate" type="date" name="fromDate" value="{{request()->query("fromDate")}}"
                               placeholder="من تاريخ"/>
                    </div>
                    <div class="field">
                        <label for="toDate">الي تاريخ</label>
                        <input id="toDate" type="date" name="toDate" value="{{request()->query("toDate")}}"
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
                <th>دائن</th>
                <th>مدين</th>
                <th>المشروع</th>
                <th>الصنف</th>
                <th>التفاصيل</th>
                <th>التاريخ</th>
            </tr>
            </thead>
            <tbody>
            @php
                $totalDeposit = 0.0;
                $totalWithdraw = 0.0;
            @endphp
            @foreach($result ? $result : [] as $row)
                @php
                    /** @var array $row */
                    if ($row->type === \App\Models\Action::ACTION_TYPE_DEPOSIT){
                        $totalDeposit += $row->amount;
                    }else if($row->type === \App\Models\Action::ACTION_TYPE_WITHDRAW){
                        $totalWithdraw += $row->amount;
                    }
                @endphp
                <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$totalDeposit - $totalWithdraw}}</td>
                    <td style="background: #0e8c8c;">
                        @if ($row->type === \App\Models\Action::ACTION_TYPE_DEPOSIT)
                            {{$row->amount}}
                        @endif
                    </td>
                    <td style="background: #c82121;">
                        @if ($row->type === \App\Models\Action::ACTION_TYPE_WITHDRAW)
                            {{$row->amount}}
                        @endif
                    </td>
                    <td>{{$row->customerName}}</td>
                    <td>{{$row->categoryName}}</td>
                    <td>{{$row->details}}</td>
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
                <div class="ui segment small header">مجموع الدائن :
                    {{$totalDeposit}}
                </div>
                <div class="ui segment small header">مجموع المدين :
                    {{$totalWithdraw}}
                </div>

                <div class="ui segment small header">المجموع الكلي :
                    {{($totalDeposit - $totalWithdraw)}}
                </div>
            </div>

            <br/>
            <a class="ui blue button">طباعة</a>
        @endif
    </div>

@stop