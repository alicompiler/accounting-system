@extends("common.layout.print_layout")

@section("container")
    <style>
        table {
            page-break-inside: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }

        thead {
            display: table-header-group
        }

        tfoot {
            display: table-footer-group
        }

        @page {
            @bottom-left {
                content: counter(page) "/===" counter(pages);
            }
        }


    </style>


        <table class="ui small right aligned celled table">
            <thead>
            <tr>
                <th>رقم العملية</th>
                <th>المجموع</th>
                <th>الارادات</th>
                <th>المصاريف</th>
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
                    <td style="background: {{intval($totalDeposit - $totalWithdraw) >= 0 ? "#45D5D4" : "#D8A48F"}}">{{$totalDeposit - $totalWithdraw}}</td>
                    <td style="">
                        @if ($row->type === \App\Models\Action::ACTION_TYPE_DEPOSIT)
                            {{$row->amount}}
                        @endif
                    </td>
                    <td style="">
                        @if ($row->type === \App\Models\Action::ACTION_TYPE_WITHDRAW)
                            {{$row->amount}}
                        @endif
                    </td>
                    <td>{{$row->customerName}}</td>
                    <td>{{$row->categoryName}}</td>
                    <td style="width: 250px;max-width: 250px;">{{$row->details}}</td>
                    <td>{{$row->date}}</td>
                </tr>
            @endforeach

            <tr>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="background: #EEE;border: none;">{{$totalDeposit}}</td>
                <td style="background: #EEE;border: none;">{{$totalWithdraw}}</td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
            </tr>
            </tbody>
        </table>


    <script>
        window.print();
    </script>
@endsection