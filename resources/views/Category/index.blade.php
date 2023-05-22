@extends('layouts.main')

@section('main-section')
<section class="box p-2">
    <h3 class="mb-2">List Kategori</h3>

    @livewire('category.show-category')
</section>


<section class="box p-2">


    @livewire('category.create-category')
</section>
@endsection