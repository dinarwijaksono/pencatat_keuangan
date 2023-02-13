<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pencatat keuangan</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="/plugins/ionic/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link href="/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    @livewireStyles
</head>

<body class="skin-blue">
    <div class="wrapper">

        <header class="main-header">
            <a href="../../index2.html" class="logo"><b>Pencatat</b> Keuangan</a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <li class="dropdown user user-menu">
                            <a href="/" class="dropdown-toggle">
                                <i class="fa fa-flag-o"></i>
                                <span class="hidden-xs">Home</span>
                            </a>
                        </li>

                        <li class="dropdown user user-menu">
                            <a href="/" class="dropdown-toggle">
                                <i class="fa fa-flag-o"></i>
                                <span class="hidden-xs">Laporan</span>
                            </a>
                        </li>

                        <li class="dropdown user user-menu" style="margin-right: 40px;">
                            <a href="/Setting" class="dropdown-toggle">
                                <i class="fa fa-flag-o"></i>
                                <span class="hidden-xs">Pengaturan</span>
                            </a>
                        </li>

                        <li class="dropdown user user-menu">
                            <a href="/" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="hidden-xs">{{ auth()->user()->username }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <!-- <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" /> -->
                                    <p>
                                        {{ auth()->user()->username }}
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                    </div>
                                    <div class="pull-right">
                                        <form action="/Auth/logout" method="post">
                                            @csrf
                                            <button class="btn btn-default btn-flat">Logout</button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>



            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <x-sidebar />
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <div class="content-wrapper">
            @yield('content-wrapper')
        </div><!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 0.0.0
            </div>
            <strong>Create app by <a href="https://instagram.com/dinarwijaksono11">Dinar wijaksono</a>.</strong>
        </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/app.min.js" type="text/javascript"></script>

    @stack('scripts')
    @livewireScripts

</body>

</html>