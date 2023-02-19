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

            <!-- left column -->
            <div class="col-md-12">

                <!-- general form elements -->
                @livewire('category.edit-category', ['category_id' => $category_id])

            </div>
        </div>


    </section><!-- /.content -->

</section>
@push('scripts')
@endpush
@endsection