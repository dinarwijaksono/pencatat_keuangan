@extends('layouts.main')

@section('main-section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Detail Kategori</h1>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                @livewire('ItemComponen.alert')
            </div>

            <div class="col-xs-12">

                <div class="box box-success">
                    <div class="box-body">
                        <p>Nama kategori : {{ $category->name }} </p>
                        <p>Type kategori : {{ $category->type }} </p>
                        <p>Dibuat : {{ date('j F Y', $category->created_at / 1000) }} </p>
                    </div>
                </div>

            </div>

            <div class="col-xs-12">
                @livewire('Transaction.ShowTransactionByCategory', ['categoryCode' => $category->code])
            </div>


        </div>
    </section>
@endsection
