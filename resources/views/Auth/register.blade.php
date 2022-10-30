<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pencatat Keuangan</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
</head>

<body class="register-page">
    <div class="register-box">
        <div class="register-logo">
            <a><b>Pencatat</b> Keuangan</a>
        </div>

        <div class="register-box-body">
            <h2 class="login-box-msg"><b>Register</b></h2>

            @if ( session('registerSuccess'))
            <div class="box box-info box-solid">
                <div class="box-header">
                    <h3 class="box-title">Sukses</h3>
                    <div class="box-tools pull-right" style="height: 30px;">
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <p>{{ session('registerSuccess') }}</p>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            @endif

            <form action="/Auth/register" method="post">
                @csrf

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" placeholder="Username" />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @error('username')
                    <p style="color: red;">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="email" placeholder="Email" />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @error('email')
                    <p style="color: red;">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password" />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @error('password')
                    <p style="color: red;">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi password" />
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @error('password_confirmation')
                    <p style="color: red;">{{$message}}</p>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-xs-8">
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div><!-- /.col -->
                </div>
            </form>

            <div class="text-center" style="margin-top: 20px;">
                <a href="/Auth/login" class="text-center">Saya sudah punya akun.</a>
            </div>

        </div><!-- /.form-box -->
    </div><!-- /.register-box -->

    <!-- jQuery 2.1.3 -->
    <script src="/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/app.min.js" type="text/javascript"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

</html>