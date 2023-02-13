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

            @livewire('add-transaction')

        </div>
    </div>

</section><!-- /.content -->
@endsection