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

            <!-- <li>
                <a href="../widgets.html">
                    <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">Hot</small>
                </a>
            </li> -->

            <li>
                <a href="/">
                    <i class="fa fa-th"></i> <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="/Category">
                    <i class="fa fa-th"></i> <span>Kategori</span>
                </a>
            </li>

            <li>
                <a href="/Transaction-history">
                    <i class="fa fa-th"></i> <span>History Transaksi</span>
                </a>
            </li>

            <li>
                <a href="/Import-export-data">
                    <i class="fa fa-th"></i> <span>Import / Export data</span>
                </a>
            </li>

            <li>
                <a href="/Report">
                    <i class="fa fa-th"></i> <span>Laporan</span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>