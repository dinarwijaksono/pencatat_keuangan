@extends('layouts.auth')

@section('main-section')

<div class="register-box">
    <div class="register-logo">
        <a><b>PENCATAT</b>_keuangan</a>
    </div>


    @livewire('auth.register-form')

</div><!-- /.register-box -->

@endsection