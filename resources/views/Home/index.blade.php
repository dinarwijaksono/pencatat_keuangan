@extends('layouts.main')

@section('main-section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Dashboard</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        @if (session()->has('allertSuccess'))
            <x-item.alert status="success" message="{{ session()->get('allertSuccess') }}" />
        @endif

        @livewire('ItemComponen.TransactionInDay', ['time' => strtotime(date('m/d/Y', time())) * 1000])

        <!-- Default box -->
        <div class="box">

            <div class="box-body table-responsive no-padding">
                <x-item.transaction-sumary-by-date :transactionSumaryByDate="$transactionSumaryByDate" />
            </div><!-- /.box-body -->

        </div><!-- /.box -->

    </section><!-- /.content -->
@endsection
