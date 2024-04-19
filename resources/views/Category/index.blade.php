@extends('layouts.main')

@section('main-section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Kategori</h1>

    </section>

    <section class="content">

        @livewire('ItemComponen.alert')

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    @livewire('Category.show-category')
                </div><!-- /.box -->
            </div>
        </div>


        <div class="row">
            @livewire('Category.create-category')
        </div>


    </section>
@endsection
