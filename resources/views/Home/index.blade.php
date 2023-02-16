@extends('layouts/main')

@section('content-wrapper')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">

        @if (session()->has('createTransactionSuccess'))
        <div class="col-xs-12">
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= session('createTransactionSuccess') ?>
            </div>
        </div>
        @endif

        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title"><?= date('D, j F Y', time()); ?></h3>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive ">
                    <table class="table">

                        @foreach ($todayTransaction as $transaction )
                        <tr>
                            <td style="width: 30%;"><?= $transaction['title'] ?></td>
                            @if ($transaction['type'] == 'income')
                            <td style="width: 30%;" class="text-right text-primary"><?= 'Rp ' . number_format($transaction['value']) ?></td>
                            <td style="width: 30%;" class="text-right text-danger"></td>
                            @else
                            <td style="width: 30%;" class="text-right text-primary"></td>
                            <td style="width: 30%;" class="text-right text-danger"><?= 'Rp. ' . number_format($transaction['value']) ?></td>
                            @endif

                            <td style="width: 10%;">
                                <a class="btn btn-xs btn-success btn-block">Edit</a>
                            </td>
                        </tr>
                        @endforeach

                        <!-- <tr>
                            <td style="width: 30%;">Roti </td>
                            <td style="width: 30%;" class="text-right text-primary"></td>
                            <td style="width: 30%;" class="text-right text-danger">Rp 10.000</td>
                            <td style="width: 10%;">
                                <a class="btn btn-xs btn-success btn-block">Edit</a>
                            </td>
                        </tr> -->

                        <tr class="bg-info">
                            <td style="width: 30%;"><b>Total </b></td>
                            <td style="width: 30%;" class="text-right text-primary"><b><?= 'Rp ' . number_format($todayTotal['income']) ?></b></td>
                            <td style="width: 30%;" class="text-right text-danger"><b><?= 'Rp ' . number_format($todayTotal['spending']) ?></b></td>
                            <td style="width: 10%;"></td>
                        </tr>

                    </table>

                </div><!-- /.box-body -->

                <div class="box-footer clearfix text-center" style="margin-top: 30px;">
                    <div class="row">
                        <div class="col-xs-4"></div>
                        <div class="col-xs-4">
                            <a href="/Transaction/addItem" class="btn btn-block btn-sm btn-primary">Tambah</a>
                        </div>
                    </div>
                </div>

            </div><!-- /.box -->
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tr>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Pemasukan</th>
                            <th class="text-center">Pengeluaran</th>
                            <th></th>
                        </tr>

                        <tbody>
                            @foreach ($listTransaction as $transaction)
                            <tr>
                                <td class="text-center"><?= date('j F Y', $transaction['date']); ?></td>
                                <td class="text-right text-primary"><?= 'Rp ' . number_format($transaction['income']) ?></td>
                                <td class="text-right text-danger"><?= 'Rp ' . number_format($transaction['spending']) ?></td>
                                <td>
                                    <a href="/Transaction/transactionDetail/<?= $transaction['date'] ?>" class="btn btn-xs btn-success btn-block">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div><!-- /.box-body -->

                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>

            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->
@endsection