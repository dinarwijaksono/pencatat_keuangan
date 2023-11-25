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

    @if (session()->has('allertSuccess'))
    <section style="padding-left: 10px; padding-right: 10px; ">
        <div class="box box-solid">
            <?php $c = true ?>
            <div class="box-body bg-green">
                <p> {{ session()->get('allertSuccess') }} </p>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section>
    @endif

    <!-- Default box -->
    <div class="box">
        @livewire('ItemComponen.TransactionInDay', ['time' => strtotime(date('m/d/Y', time()) ) * 1000 ])
    </div><!-- /.box -->


    <!-- Default box -->
    <div class="box">

        <div class="box-body table-responsive no-padding">
            <x-item.transaction-sumary-by-date :transactionSumaryByDate="$transactionSumaryByDate" />
        </div><!-- /.box-body -->

    </div><!-- /.box -->

</section><!-- /.content -->

@endsection