@extends("common.layout.print_layout")

@section("container")
    <style>


    </style>


    <div class="ui fluid container">

        <div style="display: flex;justify-content: space-between;align-items: flex-start">
            <div class="ui header" style="margin: 0;">شركة نهر الكوفة</div>
            <div class="ui header" style="margin: 0;">تقرير عام</div>
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
                    <td class="center aligned">{{$row->id}}</td>
                    <td>{{number_format($row->amount)}}</td>
                    <td>{{$row->type == \App\Models\Action::ACTION_TYPE_DEPOSIT ? "قبض" : "صرف"}}</td>
                    <td>{{$row->customerName}}</td>
                    <td>{{$row->categoryName}}</td>
                    <td class="six wide">{{$row->details}}</td>
                    <td class="three wide">{{$row->date}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        window.print();
    </script>
@endsection