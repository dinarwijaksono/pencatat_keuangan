@extends('layouts/main')

@section('content-wrapper')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
        <li><a href="/Home">Home</a></li>
        <li class="active">Tambah item</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Tambah Item</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="/Home/addItem" method="post">
                    @csrf

                    <div class="box-body">

                        <div class="form-group">
                            <label>Tanggal</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" class="form-control" />
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->

                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control">
                                <option>Pemasukan</option>
                                <option>Pengeluaran</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control">
                                <option>Makanan</option>
                                <option>Kebutuhan smartphon</option>
                                <option>Kebutuhan smartphon</option>
                                <option>Tagihan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="value">Nominal</label>
                            <input type="text" class="form-control text-right" style="padding-right: 10px;" id="value" placeholder="Nominal">
                        </div>

                    </div><!-- /.box-body -->

                    <div class="box-footer text-right">
                        <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                    </div>
                </form>
            </div><!-- /.box -->

        </div>
    </div>

</section><!-- /.content -->
@endsection