@extends('layouts/main')

@section('content-wrapper')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Pengaturan</h1>
    <ol class="breadcrumb">
        <li><a href="/Setting">Setting</a></li>
        <li class="active">Category</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Kategori</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        @if (session()->has('deleteSuccess'))
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?= session('deleteSuccess') ?>
                        </div>
                        @endif

                        @if (session()->has('updateSuccess'))
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?= session('updateSuccess') ?>
                        </div>
                        @endif

                        @livewire('category.show-category')

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


            <!-- left column -->
            <div class="col-md-12">

                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Tambah Kategori</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    @if (session()->has('createSuccess'))
                    <div class="box-body">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <!-- <h4><i class="icon fa fa-info"></i> Alert!</h4> -->
                            <?= session('createSuccess') ?>
                        </div>
                    </div>
                    @endif

                    <form action="/Category/create" method="post">
                        @csrf

                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Nama katerogi</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nama kategori" autocomplete="off">
                                @error('name')
                                <p class="text-danger"><?= $message ?></p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-control" name="type">
                                    <option value="income">Pemasukan</option>
                                    <option value="spending">Pengeluaran</option>
                                </select>
                                @error('type')
                                <p class="text-danger"><?= $message ?></p>
                                @enderror
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer ">
                            <button type="submit" class="btn btn-primary">Buat kategori</button>
                        </div>
                    </form>
                </div><!-- /.box -->

            </div>
        </div>


    </section><!-- /.content -->


    @push('scripts')
    @endpush
    @endsection