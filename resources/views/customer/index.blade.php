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
        <div>
            <form class="ui search form" action={{route("customers")}}>
                <div class="ui search field">
                    <input title="بحث" placeholder="بحث..." name="query">
                </div>
            </form>
        </div>
    </div>


    @include("customer.customers_table" , ["customers" => $customers])
@endsection