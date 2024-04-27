<header class="main-header">
    <a class="logo"><b>Pencatat</b>Keuangan</a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a class="sidebar-toggle" data-toggle="offcanvas">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><b>{{ auth()->user()->username }}</b></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <div style="height: 40px;"></div>
                            <p>
                                {{ auth()->user()->username }}
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="/profile" class="btn btn-primary btn-flat btn-sm">Profile</a>
                            </div>
                            <div class="pull-right">
                                <form method="post" action="/Auth/logout">
                                    @csrf

                                    <button type="submit" class="btn btn-block btn-danger btn-sm">Logout</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>

    </nav>
</header>
