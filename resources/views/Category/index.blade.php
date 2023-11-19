@extends('layouts.main')

@section('main-section')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Kategori</h1>

</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">List kategori</h3>
                </div><!-- /.box-header -->

                @livewire('Category.show-category')

            </div><!-- /.box -->
        </div>
    </div>


    <div class="row">
        @livewire('Category.create-category')
    </div>


</section>

@endsection