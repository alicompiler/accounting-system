@extends("common.layout.main_layout")

@section('container')
    <div>

        <table class="ui right aligned celled striped table">
            <thead>
            <tr>
                <th>الزبون</th>
                <th>دائن</th>
                <th>مدين</th>
            </tr>
            </thead>
            <tbody>
            @php($total = 0.0)
            @foreach($result ? $result : [] as $row)
                <tr>
                    <td>{{$row->name}}</td>
                    <td style="background: #0e8c8c;">
                        @if ($row->balance >= 0)
                            {{$row->balance}}
                        @endif
                    </td>
                    <td style="background: #c82121;">
                        @if ($row->balance < 0)
                            {{$row->balance}}
                        @endif
                    </td>
                </tr>
                @php($total = $total + $row->balance)
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
                <div class="ui segment small header">المجموع الكلي :
                    {{($total)}}
                </div>
            </div>
        @endif
    </div>

@stop