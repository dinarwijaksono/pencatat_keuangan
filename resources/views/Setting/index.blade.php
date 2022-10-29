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
        <div class="col-sm-12">

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Pengaturan</h3>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="/Category/index"><i class="fa fa-inbox"></i> Kategori <span class="label label-primary pull-right">12</span></a></li>
                        <!-- <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                        <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-waring pull-right">65</span></a></li>
                        <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li> -->
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /. box -->

        </div>
    </div>
</section><!-- /.content -->
@endsection