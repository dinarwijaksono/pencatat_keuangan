@extends('layouts.main')

@section('main-section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Profile</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        @livewire('item-componen.alert')

        <section class="box p-4 border-l-4 border-green-700">
            <div class="box-header">
                <h3 class="box-title">Info Profile</h3>
            </div>

            <div class="box-body">
                <div class="form-controll " style="margin-bottom: 10px;">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" disabled id="email" value="{{ auth()->user()->email }}">
                </div>

                <div class="form-controll">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" disabled id="username"
                        value="{{ auth()->user()->username }}">
                </div>
            </div>
        </section>

        @livewire('user.form-set-start-date')

    </section><!-- /.content -->
@endsection
