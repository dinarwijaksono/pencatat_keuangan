@extends('layouts.main')

@section('main-section')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Edit transaksi</h1>
</section>

<!-- Main content -->
<section class="content">

    @livewire('ItemComponen.alert')

    <section class="content">
        @livewire('transaction.EditTransaction', ['code' => $code])
    </section>

</section><!-- /.content -->
@endsection