<ul class="h-inner">
    <li class="hi-trigger ma-trigger" data-ma-action="sidebar-open" data-ma-target="#sidebar">
        <div class="line-wrap">
            <div class="line top"></div>
            <div class="line center"></div>
            <div class="line bottom"></div>
        </div>
    </li>

    <li class="hi-logo hidden-xs">
        <a href="index.html">SGDE</a>
    </li>

    <li class="pull-right">
        <ul class="hi-menu">

            <li data-ma-action="search-open">
                <a href=""><i class="him-icon zmdi zmdi-search"></i></a>
            </li>

            <li class="dropdown">
                <a data-toggle="dropdown" href="">
                    <i class="him-icon zmdi zmdi-email"></i>
                    <i class="him-counts">6</i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg pull-right">
                    <div class="list-group">
                        <div class="lg-header">
                            Messages
                        </div>
                        <div class="lg-body">
                        </div>
                        <a class="view-more" href="">View All</a>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a data-toggle="dropdown" href="">
                    <i class="him-icon zmdi zmdi-notifications"></i>
                    <i class="him-counts">9</i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg pull-right">
                    <div class="list-group him-notification">
                        <div class="lg-header">
                            Notification

                            <ul class="actions">
                                <li class="dropdown">
                                    <a href="" data-ma-action="clear-notification">
                                        <i class="zmdi zmdi-check-all"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="lg-body">
                        </div>

                        <a class="view-more" href="">View Previous</a>
                    </div>
                </div>
            </li>
            <li class="dropdown hidden-xs">
                <a data-toggle="dropdown" href="">
                    <i class="him-icon zmdi zmdi-view-list-alt"></i>
                    <i class="him-counts">2</i>
                </a>
                <div class="dropdown-menu pull-right dropdown-menu-lg">
                    <div class="list-group">
                        <div class="lg-header">
                            Tasks
                        </div>
                        <div class="lg-body">
                        </div>

                        <a class="view-more" href="">View All</a>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a data-toggle="dropdown" href=""><i class="him-icon zmdi zmdi-more-vert"></i></a>
                <ul class="dropdown-menu dm-icon pull-right">
                    <li class="divider hidden-xs"></li>
                    <li class="hidden-xs">
                        <a data-ma-action="fullscreen" href=""><i class="zmdi zmdi-fullscreen"></i> Toggle Fullscreen</a>
                    </li>
                    @if (Auth::check())
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="zmdi zmdi-settings"></i> Cerrar sesion</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    @endif
                </ul>
            </li>
        </ul>
    </li>
</ul>

<!-- Top Search Content -->
<div class="h-search-wrap">
    <div class="hsw-inner">
        <i class="hsw-close zmdi zmdi-arrow-left" data-ma-action="search-close"></i>
        <input type="text">
    </div>
</div>