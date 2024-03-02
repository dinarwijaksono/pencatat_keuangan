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

                <table class="table table-bordered" aria-describedby="table-total-income-and-spending">

                    <thead>
                        <tr>
                            <th>Deskripsi</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody style="font-size: 16px;">
                        <tr>
                            <td>Pemasukan</td>
                            <td class="text-right text-primary"> {{ number_format($total->total_income) }} </td>
                        </tr>

                        <tr>
                            <td>Pengeluaran</td>
                            <td class="text-right text-danger">{{ number_format($total->total_spending) }}</td>
                        </tr>

                        <tr style="font-weight: bold;">
                            <td>Selisih</td>
                            <td class="text-right">
                                {{ number_format($total->total_income - $total->total_spending) }}
                            </td>
                        </tr>
                    </tbody>

                </table>

            </div>
        </div>

        <div class="box box-success">
            @livewire('Report.ShowReportByPeriod')
        </div>



    </section>
@endsection
