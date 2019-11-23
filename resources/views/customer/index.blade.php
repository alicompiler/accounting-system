@extends("common.layout.main_layout")


@section("container")
    <div class="action-bar">
        <div>
            <a href="{{route("customers:create")}}" class="ui large green icon button">
                <i class="plus icon"></i>
                اضافة
            </a>

            <a href="{{route("customers:all")}}" class="ui large green icon button">
                <i class="plus icon"></i>
                كل المشاريع
            </a>
        </div>
        <div></div>
    </div>


    @include("customer.customers_table" , ["customers" => $customers])
@endsection