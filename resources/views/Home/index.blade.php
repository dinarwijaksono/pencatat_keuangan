@extends('layouts.main')

@section('main-section')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <!-- <small>it all starts here</small> -->
    </h1>
    <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol> -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        @livewire('ItemComponen.TransactionInDay')
    </div><!-- /.box -->


    <!-- Default box -->
    <div class="box">

        <div class="box-body table-responsive no-padding">
            <x-item.transaction-sumary-by-date :transactionSumaryByDate="$transactionSumaryByDate" />
        </div><!-- /.box-body -->

    </div><!-- /.box -->

</section><!-- /.content -->

@endsection