@extends("common.layout.print_layout")

@section("container")

    <style>

        .detail-segment {
            background: unset;
        }

        .item-info {
            border: 1px #EEE solid;
            padding: 0;
            margin: 8px;

        }

        .key-span {
            background: #EEEEEE;
            border-radius: 3px;
            padding: 0 8px;
            margin: unset;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .item-info > span:not(.key-span) {
            padding: 0 8px;
            width: 240px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }
    </style>


    <div class="ui fluid container">
        <div style="display: flex;justify-content: space-between;align-items: flex-start">
            <div class="ui header" style="margin: 0;">شركة نهر الكوفة</div>
            <div class="ui header" style="margin: 0;">تقرير حركة</div>
        </div>

        <hr/>

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

            <div class="item-info">
                <span class="key-span">الرصيد قبل العملية</span>
                <span>{{$action->prevBalance}}</span>
            </div>

            <div class="item-info">
                <span class="key-span">الرصيد الحالي</span>
                <span>{{$action->newBalance}}</span>
            </div>

        </div>
    </div>


@endsection