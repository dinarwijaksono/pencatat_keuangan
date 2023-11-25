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

        <div class="box-header">
            <h3 class="box-title">Senin, 10 april 2023</h3>
        </div><!-- /.box-header -->

        <div class="box-body table-responsive no-padding">
            <table class="table table-hover ">
                <tr>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center" colspan="2">Nilai</th>
                </tr>
                <tr>
                    <td class="text-center">makanan</td>
                    <td class="text-center">makan siang</td>
                    <td class="text-right text-blue"></td>
                    <td class="text-right text-red">Rp 23.000</td>
                </tr>

                <tr>
                    <td class="text-right" colspan="2"><b>Total</b></td>
                    <td class="text-right text-green"><b>Rp 0</b></td>
                    <td class="text-right text-red"><b>Rp 10.000</b></td>
                </tr>

            </table>
        </div><!-- /.box-body -->

        <div class="box-header">
            <div class="row ">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <a href="/Transaction/add-item" class="btn btn-block btn-sm bg-green">Tambah transaksi</a>
                </div>
            </div>
        </div>

    </div><!-- /.box -->

    <!-- Default box -->
    <div class="box">

        <div class="box-body table-responsive no-padding">
            <x-item.transaction-sumary-by-date :transactionSumaryByDate="$transactionSumaryByDate" />
        </div><!-- /.box-body -->

    </div><!-- /.box -->

</section><!-- /.content -->

@endsection