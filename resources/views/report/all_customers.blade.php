@extends("common.layout.main_layout")

@section('container')
    <div>

        <table class="ui right aligned celled striped table">
            <thead>
            <tr>
                <th>الزبون</th>
                <th>الارادات</th>
                <th>المصاريف</th>
            </tr>
            </thead>
            <tbody>
            @php
                $total = 0.0;$forMe = 0;$onMe = 0;
            @endphp

            @foreach($result ? $result : [] as $row)

                @php
                    $balance = $row->balance();
                    $total = $total + $balance;
                    if ($balance > 0) $onMe += $balance;
                    if ($balance < 0) $forMe += $balance;
                @endphp

                <tr>
                    <td>{{$row->name}}</td>
                    <td style="background: #45D5D4;">
                        @if ($balance >= 0)
                            {{number_format($balance)}}
                        @endif
                    </td>
                    <td style="background: #D8A48F;">
                        @if ($balance < 0)
                            {{number_format($balance)}}
                        @endif
                    </td>
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
                <div class="ui segment small header">الدائن :
                    {{(number_format($onMe))}}
                </div>
                <div class="ui segment small header">المدين :
                    {{(number_format($forMe))}}
                </div>

                <div class="ui segment small header">المجموع الكلي :
                    {{(number_format($total))}}
                </div>
            </div>
        @endif
    </div>

@stop