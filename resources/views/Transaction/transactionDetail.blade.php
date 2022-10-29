@extends('layouts/main')

@section('content-wrapper')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title"><?= date('D, d F Y', time()); ?></h3>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive ">
                    <table class="table">

                        <tr>
                            <td style="width: 30%;">Roti </td>
                            <td style="width: 30%;" class="text-right text-primary">Rp 10.000</td>
                            <td style="width: 30%;" class="text-right text-danger"></td>
                            <td style="width: 10%;">
                                <a class="btn btn-xs btn-success btn-block">Edit</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 30%;">Roti </td>
                            <td style="width: 30%;" class="text-right text-primary"></td>
                            <td style="width: 30%;" class="text-right text-danger">Rp 10.000</td>
                            <td style="width: 10%;">
                                <a class="btn btn-xs btn-success btn-block">Edit</a>
                            </td>
                        </tr>

                        <tr class="bg-info">
                            <td style="width: 30%;"><b>Total </b></td>
                            <td style="width: 30%;" class="text-right text-primary"><b>Rp 20.000</b></td>
                            <td style="width: 30%;" class="text-right text-danger"><b>Rp 10.000</b></td>
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

</section><!-- /.content -->
@endsection