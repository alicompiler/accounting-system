@extends("common.layout.main_layout")


@section("container")

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
    </div>
@endsection