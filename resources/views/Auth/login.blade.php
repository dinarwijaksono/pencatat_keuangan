@extends('layouts.auth')

@section('main-section')
<div class="login-box">
    <div class="login-logo">
        <a><b>PENCATAT</b>_keuangan</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <form action="../../index2.html" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Email" />
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <!-- <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div> -->
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div><!-- /.col -->
            </div>
        </form>

        <a href="/Auth/register" class="text-center">Saya belum mempunyai akun.</a>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<!-- <section class="flex flex-row justify-center"> -->
<!-- @livewire('auth.login-form') -->
<!-- </section> -->
@endsection