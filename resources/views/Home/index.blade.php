@extends('layouts.main')

@section('main-section')
<section class="box">
    <h3 class="mb-2">Pencatat Keuangan</h3>

    <table class="w-full text-[14px] mb-3" cellpading="1">
        <tr>
            <td>Senin, 12 Maret 2022</td>
            <td class="text-end text-success">Rp 100.000</td>
        </tr>
        <tr class="border-b-2 border-slate-500">
            <td></td>
            <td class="text-end text-danger">Rp 50.000</td>
        </tr>
    </table>


    <table class="w-full text-[14px] mb-6">
        <tr class="border-b border-slate-200">
            <td class="">Ayam goreng</td>
            <td class="text-end text-danger">Rp 10.000</td>
        </tr>
        <tr class="border-b border-slate-200">
            <td class="">Ayam goreng</td>
            <td class="text-end text-success">Rp 10.000</td>
        </tr>
    </table>

    <div class="flex justify-center">
        <div class="basis-1/3">
            <button class="btn-sm bg-success rounded">Tambah</button>
        </div>
    </div>

</section>

<section class="box">

    <table class="text-[14px] w-full mb-8">
        <tr>
            <td rowspan="2" class="text-center bg-green-200 w-3/12 border-t border-l border-b border-slate-400">
                Senin, 12 Maret
                2022</td>
            <td class="w-2/12 border-t border-slate-400 px-1">Pemasukan</td>
            <td class="text-center w-1/12 border-t border-slate-400">:</td>
            <td class="w-auto text-success text-end px-3 border-t border-slate-400">Rp 100.000</td>
            <td rowspan="2" class="p-2 w-2/12 border-t border-r border-b border-slate-400">
                <a href="/" class="btn-sm bg-success rounded">Detail</a>
            </td>
        </tr>
        <tr>
            <td class="w-2/12 border-b border-slate-400 px-1">Pengeluaran</td>
            <td class="text-center w-1/12 border-b border-slate-400">:</td>
            <td class="w-auto text-danger text-end px-3 border-b border-slate-400">Rp 8.000.000</td>
        </tr>
    </table>

    <div>
        <ul class=" text-center">
            <li class="inline-block"><button class="btn-sm mx-1 bg-success">Sebelumnya</button></li>
            <li class="inline-block"><button class="btn-sm mx-1 bg-gray-500 font-bold">1</button></li>
            <li class="inline-block"><button class="btn-sm mx-1 bg-success">Selanjutnya</button></li>
        </ul>
    </div>

</section>
@endsection