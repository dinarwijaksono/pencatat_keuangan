@extends('layouts.main')

@section('main-section')
<section class="box">
    @livewire('transaction.edit-transaction', ['code' => $code])
</section>
@endsection