@extends('layouts.main')

@section('main-section')
    <section>
        <h1>Transaksi</h1>
    </section>

    <section class="content">
        @livewire('transaction.add-item', ['time' => $time])
    </section>
@endsection
