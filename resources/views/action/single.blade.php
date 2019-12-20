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

    @include("action.display_action" , ["action" => $action])

    <br/><br/>

    <div>
        <a target="_black" href="{{route("print:single-action" , ["id" => $action->id])}}}" class="ui icon button blue">
            <i class="print icon"></i>
            طباعة
        </a>
        <a class="ui icon button yellow" href="{{route("actions:edit" , ["id" => $action->id])}}">
            <i class="edit icon"></i>
            تعديل
        </a>
        <a class="ui icon button red" href="{{route("actions:delete" , ["id" => $action->id])}}">
            <i class="trash icon"></i>
            حذف
        </a>
    </div>
@endsection