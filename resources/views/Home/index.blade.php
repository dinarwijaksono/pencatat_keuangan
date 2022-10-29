<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Beranda</title>
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
                            <a href="/" class="dropdown-toggle">
                                <i class="fa fa-flag-o"></i>
                                <span class="hidden-xs">Pengaturan</span>
                            </a>
                        </li>

                        <li class="dropdown user user-menu">
                            <a href="/" class="dropdown-toggle">
                                <i class="fa fa-flag-o"></i>
                                <span class="hidden-xs">Dinar wijaksono</span>
                            </a>
                        </li>

                    </ul>
                </div>



            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                    </div>
                    <div class="pull-left info">
                        <p>Alexander Pierce</p>

                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search..." />
                        <span class="input-group-btn">
                            <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                            <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-files-o"></i>
                            <span>Layout Options</span>
                            <span class="label label-primary pull-right">4</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                            <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                            <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                            <li><a href="../layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="../widgets.html">
                            <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>Charts</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                            <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                            <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-laptop"></i>
                            <span>UI Elements</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                            <li><a href="../UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                            <li><a href="../UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                            <li><a href="../UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                            <li><a href="../UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                            <li><a href="../UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-edit"></i> <span>Forms</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                            <li><a href="../forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                            <li><a href="../forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
                        </ul>
                    </li>
                    <li class="treeview active">
                        <a href="#">
                            <i class="fa fa-table"></i> <span>Tables</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                            <li><a href="data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="../calendar.html">
                            <i class="fa fa-calendar"></i> <span>Calendar</span>
                            <small class="label pull-right bg-red">3</small>
                        </a>
                    </li>
                    <li>
                        <a href="../mailbox/mailbox.html">
                            <i class="fa fa-envelope"></i> <span>Mailbox</span>
                            <small class="label pull-right bg-yellow">12</small>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-folder"></i> <span>Examples</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                            <li><a href="../examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                            <li><a href="../examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                            <li><a href="../examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                            <li><a href="../examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                            <li><a href="../examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                            <li><a href="../examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-share"></i> <span>Multilevel</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                            <li>
                                <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                                    <li>
                                        <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                                        <ul class="treeview-menu">
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                        </ul>
                    </li>
                    <li><a href="../../documentation/index.html"><i class="fa fa-book"></i> Documentation</a></li>
                    <li class="header">LABELS</li>
                    <li><a href="#"><i class="fa fa-circle-o text-danger"></i> Important</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-warning"></i> Warning</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-info"></i> Information</a></li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Dashboard</h1>
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Examples</a></li>
                    <li class="active">Blank page</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">

                            <div class="box-header">
                                <h3 class="box-title"><?= date('D, d F Y', time()); ?></h3>
                            </div><!-- /.box-header -->

                            <div class="box-body table-responsive ">
                                <table class="table">

                                    <tr>
                                        <td style="width: 30%;">Roti </td>
                                        <td style="width: 30%;" class="text-right text-primary">Rp 10.000</td>
                                        <td style="width: 30%;" class="text-right text-danger"></td>
                                        <td style="width: 10%;">
                                            <a class="btn btn-xs btn-success btn-block">Edit</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width: 30%;">Roti </td>
                                        <td style="width: 30%;" class="text-right text-primary"></td>
                                        <td style="width: 30%;" class="text-right text-danger">Rp 10.000</td>
                                        <td style="width: 10%;">
                                            <a class="btn btn-xs btn-success btn-block">Edit</a>
                                        </td>
                                    </tr>

                                    <tr class="bg-info">
                                        <td style="width: 30%;"><b>Total </b></td>
                                        <td style="width: 30%;" class="text-right text-primary"><b>Rp 20.000</b></td>
                                        <td style="width: 30%;" class="text-right text-danger"><b>Rp 10.000</b></td>
                                        <td style="width: 10%;"></td>
                                    </tr>

                                </table>

                            </div><!-- /.box-body -->

                            <div class="box-footer clearfix text-center" style="margin-top: 30px;">
                                <div class="row">
                                    <div class="col-xs-4"></div>
                                    <div class="col-xs-4">
                                        <a href="/Transaction/addItem" class="btn btn-block btn-sm btn-primary">Tambah</a>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /.box -->
                    </div>

                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">

                            <div class="box-body table-responsive no-padding">
                                <table class="table">
                                    <tr>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Pemasukan</th>
                                        <th class="text-center">Pengeluaran</th>
                                        <th></th>
                                    </tr>

                                    <tbody>
                                        <?php for ($i = 0; $i < 15; $i++) : ?>
                                            <tr>
                                                <td class="text-center"><?= date('d F Y', time()); ?></td>
                                                <td class="text-right text-primary">Rp 10.000</td>
                                                <td class="text-right text-danger">Rp 10.000</td>
                                                <td>
                                                    <a href="/Transaction/transactionDetail" class="btn btn-xs btn-success btn-block">Detail</a>
                                                </td>
                                            </tr>
                                        <?php endfor ?>
                                    </tbody>

                                </table>
                            </div><!-- /.box-body -->

                            <div class="box-footer clearfix">
                                <ul class="pagination pagination-sm no-margin pull-right">
                                    <li><a href="#">&laquo;</a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">&raquo;</a></li>
                                </ul>
                            </div>

                        </div><!-- /.box -->
                    </div>
                </div>

            </section><!-- /.content -->
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
</body>

</html>