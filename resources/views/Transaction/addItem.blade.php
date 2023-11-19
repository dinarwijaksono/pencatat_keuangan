@extends('layouts.main')

@section('main-section')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Transaksi</h1>
    <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol> -->
</section>

<!-- Main content -->
<section class="content">
    @livewire('transaction.add-item')
</section>

@endsection