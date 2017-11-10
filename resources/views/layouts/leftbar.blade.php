<aside id="sidebar" class="sidebar c-overflow">
    <div class="s-profile">
        <a href="" data-ma-action="profile-menu-toggle">
            <div class="sp-pic">
                <img src="{{ asset('administracion/img/profile-pics/1.jpg') }}" alt="">
            </div>

            <div class="sp-info">
                @if (Auth::check())
                Name
                @else
                Jarvis
                @endif

                <i class="zmdi zmdi-caret-down"></i>
            </div>
        </a>
        <ul class="main-menu">
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
    </div>
    <ul class="main-menu">
        <li class="active">
            <a href="index.html"><i class="zmdi zmdi-home"></i> Inicio</a>
        </li>
        <li>
            <a href="index.html"><i class="zmdi zmdi-face"></i> Bautismos</a>
        </li>
        <li>
            <a href="index.html"><i class="zmdi zmdi-local-library"></i> Comuniones</a>
        </li>
        <li>
            <a href="index.html"><i class="zmdi zmdi-graduation-cap"></i> Confirmaciones</a>
        </li>
        <li>
            <a href="index.html"><i class="zmdi zmdi-local-wc"></i> Matrimonios</a>
        </li>
        <li>
            <a href="index.html"><i class="zmdi zmdi-account-calendar"></i> Osarios</a>
        </li>
        <li>
            <a href="index.html"><i class="zmdi zmdi-account-calendar"></i> Cenizarios</a>
        </li>
        <li>
            <a href="index.html"><i class="zmdi zmdi-account-calendar"></i> Defunciones</a>
        </li>
        <li class="sub-menu">
            <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Centro de datos</a>
            <ul>
                <li><a href="textual-menu.html">Bautismos</a></li>
                <li><a href="image-logo.html">Comuniones</a></li>
                <li><a href="top-mainmenu.html">Matrimonios</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-menu"></i> 3 Level Menu</a>

            <ul>
                <li><a href="form-elements.html">Level 2 link</a></li>
                <li><a href="form-components.html">Another level 2 Link</a></li>
                <li class="sub-menu">
                    <a href="" data-ma-action="submenu-toggle">I have children too</a>

                    <ul>
                        <li><a href="">Level 3 link</a></li>
                        <li><a href="">Another Level 3 link</a></li>
                        <li><a href="">Third one</a></li>
                    </ul>
                </li>
                <li><a href="form-validations.html">One more 2</a></li>
            </ul>
        </li>
        <li>
            <a href="https://wrapbootstrap.com/theme/material-admin-responsive-angularjs-WB011H985"><i class="zmdi zmdi-money"></i> Buy this template</a>
        </li>
    </ul>
</aside>