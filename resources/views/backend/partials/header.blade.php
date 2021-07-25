<header class="header dark-bg">
    <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom">
            <i class="icon_menu"></i>
        </div>
    </div>

    <a href="index.html" class="logo">SI <span class="lite">ALUMNI</span></a>

    <div class="nav search-row" id="top_menu">
        <ul class="nav top-menu">
            <li>
            <form class="navbar-form">
                <input class="form-control" placeholder="Search" type="text">
            </form>
            </li>
        </ul>
    </div>

    <div class="top-nav notification-row">
        <ul class="nav pull-right top-menu">
            <li id="task_notificatoin_bar" class="dropdown">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="username">{{ Auth::user()->name }}</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <div class="log-arrow-up"></div>
                        <li>
                            <a href="{{ route('logout') }}"><i class="icon_key_alt"></i> Log Out</a>
                        </li>
                    </ul>
                </li>        
            </li>
        </ul>
    </div>
</header>