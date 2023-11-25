@extends('layouts.main')

@section('main-section')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Transaksi</h1>
</section>

<!-- Main content -->
<section class="content">

    @livewire('ItemComponen.alert')

    <!-- Default box -->
    <div class="box">
        @livewire('ItemComponen.TransactionInDay', ['time' => $time ])
    </div><!-- /.box -->

</section><!-- /.content -->
@endsection