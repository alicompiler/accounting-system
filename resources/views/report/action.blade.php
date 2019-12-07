@extends("common.layout.main_layout")

@section('container')
    <div>
        <form class="ui form">

            <div style="display: inline-flex;align-items: flex-end;">

                <div class="fields" style="display: inline-flex;margin: 0;">

                    <div class="field">
                        <label for="fromDate">من تاريخ</label>
                        <input id="fromDate" type="date" name="fromDate" value="{{request()->query("fromDate" , date('Y-m-d'))}}"
                               placeholder="من تاريخ"/>
                    </div>
                    <div class="field">
                        <label for="toDate">الي تاريخ</label>
                        <input id="toDate" type="date" name="toDate" value="{{request()->query("toDate" , date('Y-m-d'))}}"
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
                <th>المبلغ</th>
                <th>النوع</th>
                <th>المشروع</th>
                <th>الصنف</th>
                <th>التفاصيل</th>
                <th>التاريخ</th>
            </tr>
            </thead>
            <tbody>
            @foreach($result ? $result : [] as $row)
                <tr>
                    <td class="center aligned">
                        <a class="ui blue button" href="{{route("actions:single" , ["id" => $row->id])}}">
                            {{$row->id}}
                        </a>
                    </td>
                    <td>{{number_format($row->amount)}}</td>
                    <td>{{$row->type == \App\Models\Action::ACTION_TYPE_DEPOSIT ? "قبض" : "صرف"}}</td>
                    <td>{{$row->customerName}}</td>
                    <td>{{$row->categoryName}}</td>
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
            <br/>
            <a target="_blank" href="{{route("print:action" , [
                        "fromDate" => request()->route()->parameter("fromDate") ,
                        "toDate" => request()->route()->parameter("toDate")]
                        )
                     }}"
               class="ui blue button">طباعة</a>
        @endif
    </div>

@stop