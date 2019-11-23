<div class="sidebar">

    <div id="main-menu">
        @include('common.layout.menu')
    </div>

    <div id="sidebar" class="ui right sidebar">
        @include('common.layout.menu')
    </div>

</div>


<script>

    $(".ui.sidebar").sidebar({
        transition : 'overlay',
    });


</script>