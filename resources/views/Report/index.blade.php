@extends('layouts.main')

@section('main-section')
    <section class="content-header">
        <h1>Laporan</h1>
    </section>

    <section class="content">

        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Pemasukan vs Pengeluaran (Semua periode)</h3>
            </div><!-- /.box-header -->

            <div class="box-body">

                <table class="table-simple w-full" aria-describedby="table-total-income-and-spending">

                    <thead>
                        <tr>
                            <th>Deskripsi</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody style="font-size: 16px;">
                        <tr class="border-b border-slate-300">
                            <td class="p-1">Pemasukan</td>
                            <td class="p-1 text-right text-primary"> {{ number_format($total->total_income) }} </td>
                        </tr>

                        <tr class="border-b border-slate-300">
                            <td class="p-1">Pengeluaran</td>
                            <td class="text-right text-danger">{{ number_format($total->total_spending) }}</td>
                        </tr>

                        <tr class="font-bold border-b border-slate-300">
                            <td class="p-1">Selisih</td>
                            <td class="text-right p-1">
                                {{ number_format($total->total_income - $total->total_spending) }}
                            </td>
                        </tr>
                    </tbody>

                </table>

            </div>
        </div>

        @livewire('Report.ShowReportByPeriod')

    </section>
@endsection
