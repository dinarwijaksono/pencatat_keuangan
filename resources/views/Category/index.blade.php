@extends('layouts.main')

@section('main-section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Kategori</h1>

    </section>

    <section class="content">

        @livewire('ItemComponen.alert')

        @livewire('Category.show-category')

        @livewire('Category.create-category')

    </section>
@endsection
