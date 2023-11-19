<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PencatatKeuangan</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="/adminLTE/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/adminLTE/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="/adminLTE/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="skin-green">

    <!-- Site wrapper -->
    <div class="wrapper">

        <x-navbar />

        <!-- =============================================== -->

        <x-sidebar />

        <!-- =============================================== -->

        <!-- Right side column. Contains the navbar and content of the page -->
        <div class="content-wrapper">
            @yield('main-section')
        </div><!-- /.content-wrapper -->

        <!-- =============================================== -->

        <x-footer />

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="/adminLTE/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="/adminLTE/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="/adminLTE/plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='/adminLTE/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="/adminLTE/dist/js/app.min.js" type="text/javascript"></script>
</body>

</html>