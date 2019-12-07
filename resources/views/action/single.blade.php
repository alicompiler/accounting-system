@extends("common.layout.main_layout")


@section("container")

    <div class="ui form">
        <div class="ui labeled input">
            <label class="ui label">رقم العملية</label>
            <input name="actionId" id="actionId" value="{{request()->route()->parameter("id")}}" type="number" title=""/>
        </div>
    </div>

    <script>
        const input = document.getElementById("actionId");
        input.onkeyup = function gotoActionPage(e) {
            console.log(e);
            if (e.code == "Enter") {
                const id = document.getElementById("actionId").value;
                if (parseInt(id) > 0)
                    window.location.href = "/actions/" + id;
            }
        }
    </script>

    <div class="ui large header">
        تقرير عن عملية مالية
    </div>

    <div class="detail-segment">
        <div class="item-info">
            <span class="key-span">رقم العملية</span>
            <span>{{$action->id}}</span>
        </div>

        <div class="item-info">
            <span class="key-span">الزبون</span>
            <span>{{$action->customer->name}}</span>
        </div>

        <div class="item-info">
            <span class="key-span">المبلغ</span>
            <span>{{$action->amount}}</span>
        </div>

        <div class="item-info">
            <span class="key-span">نوع العملية</span>
            <span>
                @if($action->type === \App\Models\Action::ACTION_TYPE_WITHDRAW)
                    صرف
                @elseif($action->type === \App\Models\Action::ACTION_TYPE_DEPOSIT)
                    قبض
                @else
                    -
                @endif
            </span>
        </div>

        <div class="item-info">
            <span class="key-span">التاريخ</span>
            <span>{{$action->date}}</span>
        </div>

        <div class="item-info">
            <span class="key-span">التاريخ الانشاء</span>
            <span>{{date('Y-m-d' , strtotime($action->created_at))}}</span>
        </div>

        <div class="item-info">
            <span class="key-span">التصنيف</span>
            <span>{{$action->category->name}}</span>
        </div>

        <div class="item-info">
            <span class="key-span">التفاصيل</span>
            <span>{!! nl2br(htmlentities($action->details)) !!}</span>
        </div>
    </div>

    <br/><br/>

    <div>
        <button class="ui icon button blue">
            <i class="print icon"></i>
            طباعة
        </button>
        <a class="ui icon button yellow" href="{{route("actions:edit" , ["id" => $action->id])}}">
            <i class="edit icon"></i>
            تعديل
        </a>
    </div>
@endsection