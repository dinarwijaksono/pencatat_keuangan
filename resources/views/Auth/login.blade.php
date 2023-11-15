@extends('layouts.auth')

@section('main-section')
<div class="login-box">
    <div class="login-logo">
        <a><b>PENCATAT</b>_keuangan</a>
    </div><!-- /.login-logo -->

    @livewire('auth.login-form')

</div><!-- /.login-box -->




@endsection