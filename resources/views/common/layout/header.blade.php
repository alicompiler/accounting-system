<div class="app-header">
    <div class="action-bar">
        <div>
            <button id="drawer-button" data-transition="overlay"
                    onclick="$('.ui.sidebar').sidebar('toggle');"
                    class="ui icon button">
                <i class="icon align justify"></i>
            </button>
        </div>
        <div>
            <div class="actions">

                <a href="{{route('logout')}}" class="ui icon button">
                    <i class="icon sign out alternate"></i>
                </a>
            </div>
        </div>
    </div>

</div>