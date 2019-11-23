<table class="ui right aligned celled striped table">
    <thead>
    <tr>
        <th>#</th>
        <th>الاسم</th>
        <th>الهاتف</th>
        <th>العنوان</th>
        <th>الرصيد</th>
        <th>تاريخ الاضافة</th>
        <th>العمليات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
        <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->name}}</td>
            <td>{{$customer->phone}}</td>
            <td>{{$customer->address}}</td>
            <td style="text-align:center;background: {{$customer->balance < 0 ? "#ff4335" : "#00b5ad"}}">{{$customer->balance}}</td>
            <td>{{date('Y-m-d' , strtotime($customer->created_at))}}</td>
            <td>
                <a href="{{route("customers:edit" , ["id" => $customer->id])}}" class="ui icon yellow button">
                    <i class="edit icon"></i>
                </a>
                @if($customer->active)
                    <a href="{{route("customers:disable" , ["id" => $customer->id])}}" class="ui icon red button">
                        <i class="lock icon"></i>
                    </a>
                @else
                    <a href="{{route("customers:active" , ["id" => $customer->id])}}" class="ui icon green button">
                        <i class="lock open icon"></i>
                    </a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>