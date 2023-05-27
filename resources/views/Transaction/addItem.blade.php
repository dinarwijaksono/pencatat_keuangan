@extends('layouts.main')

@section('main-section')
<section class="box">
    @livewire('transaction.add-item', ['time' => $time])
</section>
@endsection