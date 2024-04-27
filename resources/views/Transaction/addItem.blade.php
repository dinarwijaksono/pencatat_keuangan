@extends('layouts.main')

@section('main-section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Transaksi</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @livewire('transaction.add-item', ['time' => $time])
    </section>
@endsection
