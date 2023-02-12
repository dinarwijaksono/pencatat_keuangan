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
                <form action="/Transaction/addItem" method="post">
                    @csrf

                    <div class="box-body">

                        <div class="form-group">
                            <label>Tanggal</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" name="date" class="form-control" value="<?= old('date') ?>" />
                            </div><!-- /.input group -->
                            @error('date')
                            <p class="text-danger"><?= $message ?></p>
                            @enderror
                        </div><!-- /.form group -->

                        <!-- <div class="form-group">
                            <label>Type</label>
                            <select class="form-control">
                                <option>Pemasukan</option>
                                <option>Pengeluaran</option>
                            </select>
                        </div> -->

                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="category">
                                <option value="">Pilih kategori</option>
                                @foreach ($listCategory as $category)
                                @if (old('category') == $category['name'] )
                                <option selected value="<?= $category['name'] ?>"><?= $category['type'] . ' - ' . $category['name'] ?></option>
                                @else
                                <option value="<?= $category['name'] ?>"><?= $category['type'] . ' - ' . $category['name'] ?></option>
                                @endif
                                @endforeach
                            </select>
                            @error('category')
                            <p class="text-danger"><?= $message ?></p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="value">Nominal</label>
                            <input type="number" name="value" class="form-control text-right" style="padding-right: 10px;" id="value" placeholder="Nominal" value="<?= old('value') ?>">
                            @error('value')
                            <p class="text-danger"><?= $message ?></p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="value">Judul</label>
                            <input type="text" name="title" class="form-control " id="value" placeholder="Judul" value="<?= old('title') ?>">
                            @error('title')
                            <p class=" text-danger"><?= $message ?></p>
                            @enderror
                        </div>

                    </div><!-- /.box-body -->

                    <div class="box-footer text-right">
                        <a href="/" class="btn btn-sm btn-danger">Batal</a>
                        <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                    </div>
                </form>
            </div><!-- /.box -->

        </div>
    </div>

</section><!-- /.content -->
@endsection