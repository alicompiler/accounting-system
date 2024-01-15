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
        <span class="key-span">صنف العملية</span>
        <span>{{$action->category ? $action->category->name : '-'}}</span>
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
        <span class="key-span">التفاصيل</span>
        <span>{!! nl2br(htmlentities($action->details)) !!}</span>
    </div>

    <div class="item-info">
        <span class="key-span">انشئت بواسطة</span>
        <span>{{$action->createdBy ? $action->createdBy->name : '-'}}</span>
    </div>

    <div class="item-info">
        <span class="key-span">تم الانشاء في</span>
        <span>{{$action->created_at}}</span>
    </div>

    <div class="item-info">
        <span class="key-span">اخر تعديل بواسطة</span>
        <span>{{$action->updatedBy ? $action->updatedBy->name : '-'}}</span>
    </div>

    <div class="item-info">
        <span class="key-span">اخر تعديل في</span>
        <span>{{$action->updated_at}}</span>
    </div>

    @if(count($action->files) > 0)
        <div class="item-info">
            <span class="key-span">المرفقات</span>
            <div style="display: flex;flex-direction: column;gap: 8px;">
                @foreach($action->files as $file)
                    @if($file->is_image == 1)
                        <a href="{{route('actions:image', ['filename' => $file->filename])}}">
                            <img style="width: 128px" src="{{route('actions:image', ['filename' => $file->filename])}}" alt="">
                        </a>
                    @else
                        <a class="ui button" href="{{route('actions:file', ['filename' => $file->filename])}}" >{{$file->filename}}</a>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
</div>