<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PencatatKeuangan</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="adminLTE/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="adminLTE/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="adminLTE/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="skin-green">

    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <a class="logo"><b>Pencatat</b>Keuangan</a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a class="sidebar-toggle" data-toggle="offcanvas" role="button">
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
                                    <!-- <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" /> -->

                                    <div style="height: 40px;"></div>

                                    <p>
                                        {{ auth()->user()->username }}
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <!-- <a href="#" class="btn btn-default btn-flat btn-sm">Profile</a> -->
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

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <!-- <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" /> -->
                    </div>
                    <div class="pull-left info">
                        <p>{{ auth()->user()->username }}</p>

                        <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
                    </div>
                </div>

                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>

                    <!-- <li class="treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                            <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                        </ul>
                    </li> -->

                    <li>
                        <a href="../widgets.html">
                            <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">Hot</small>
                        </a>
                    </li>

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->

        @yield('main-section')

        <!-- =============================================== -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <!-- <b>Version</b> 2.0 -->
            </div>
            <p><strong>Copyright &copy; 2023 <a href="http://almsaeedstudio.com">Dinarwijaksono11@gmail.com</a>.</strong> All rights
                reserved.</p>
            <p><strong>Template by <a href="https://adminlte.io/">AdminLTE</a></strong></p>
        </footer>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="adminLTE/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="adminLTE/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="adminLTE/plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='adminLTE/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="adminLTE/dist/js/app.min.js" type="text/javascript"></script>
</body>

</html>