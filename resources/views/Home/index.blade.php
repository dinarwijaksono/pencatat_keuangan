@extends('layouts/main2')

@section('content')
<section class="p-2">
    <h1 class="text-[24px]">Dashboard</h1>
</section>

@if (session()->has('createTransactionSuccess'))
<div class="bg-green-500 p-2 w-full mb-4 relative rounded">
    <button type="button" class="absolute top-2 right-2 p-0 text-slate-300 text-[14px]">
        <i class="fa-solid fa-xmark"></i>
    </button>

    <p class="text-white text-[14px]"><?= session('createTransactionSuccess') ?></p>
</div>
@endif

@if (session()->has('deleteSuccess'))
<div class="bg-red-500 p-2 w-full mb-4 relative rounded">
    <button type="button" class="absolute top-2 right-2 p-0 text-slate-300 text-[14px]">
        <i class="fa-solid fa-xmark"></i>
    </button>

    <p class="text-white text-[14px]"><?= session('deleteSuccess') ?></p>
</div>
@endif

@if (session()->has('updateSuccess'))
<div class="bg-gren-500 p-2 w-full mb-4 relative rounded">
    <button type="button" class="absolute top-2 right-2 p-0 text-slate-300 text-[14px]">
        <i class="fa-solid fa-xmark"></i>
    </button>

    <p class="text-white text-[14px]"><?= session('updateSuccess') ?></p>
</div>
@endif

<section class="bg-white drop-shadow-xl p-2 mb-6 border rounded border-t-4 border-b-0 border-x-0 border-sky-500 ">
    <h1 class="text-[16px] text-slate-600 mb-3"><?= date('D, j F Y', time()); ?></h1>

    @livewire('home.show-today-transaction')

    <div class="mt-6 text-center">
        <a href="/Transaction/addItem" class="bg-sky-600 text-white rounded text-[12px] py-1 inline-block w-40">Tambah</a>
    </div>
</section>

<section class="bg-white drop-shadow-xl p-2 border rounded border-t-4 border-b-0 border-x-0 border-sky-500 ">
    <table class="table-auto border-collapse w-full text-[14px]">
        <thead>
            <tr class="border border-t-0 border-b-2 border-x-0 border-slate-200 text-center">
                <th class="w-3/12">Tanggal</th>
                <th class="w-3/12 text-right">Pemasukan</th>
                <th class="w-3/12 text-right">Pengeluaran</th>
                <th class="w-3/12"></th>
            </tr>
        </thead>
        <tbody>

            @foreach ($listTransaction as $transaction)
            <tr class="border border-t-0 border-b-1 border-x-0 border-slate-200 text-center">
                <!-- <td class="p-2 ">12 Januari 2023</td> -->
                <td class="p-2 "><?= date('d F Y', $transaction['date']) ?></td>
                <td class="p-2 text-right text-sky-800">Rp 30.000</td>
                <td class="p-2 text-right text-red-500">Rp 30.000</td>
                <td class="p-2 ">
                    <a href="/Transaction/transactionDetail/<?= $transaction['date'] ?>" class="inline-block bg-green-500 p-1 w-full rounded text-white text-[12px]">Detail</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <div class="mt-6 ">

        <div class="flex justify-center text-center text-[14px]">
            <div class="border">
                <a href="#" class="w-7 hover:bg-slate-200 inline-block">
                    <i class="fa-solid fa-caret-left"></i>
                </a>
            </div>

            <div class="border"><a href="#" class="w-7 hover:bg-slate-200 inline-block"> 1</a></div>
            <div class="border"><a href="#" class="w-7 hover:bg-slate-200 inline-block"> 2</a></div>
            <div class="border"><a href="#" class="w-7 hover:bg-slate-200 inline-block"> 3</a></div>
            <div class="border"><a href="#" class="w-7 hover:bg-slate-200 inline-block"> 4</a></div>
            <div class="border"><a href="#" class="w-7 hover:bg-slate-200 inline-block"> 5</a></div>

            <div class="border">
                <a href="#" class="w-7 hover:bg-slate-200 inline-block">
                    <i class="fa-solid fa-caret-right"></i>
                </a>
            </div>
        </div>

    </div>

</section>

@endsection