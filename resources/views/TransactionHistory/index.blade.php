@extends('layouts.main')

@section('main-section')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Transaksi History</h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">

            <div class="box box-success">

                <div class="box-header">
                    <h3 class="box-title">List kategori</h3>
                </div><!-- /.box-header -->

                <div class="box-body no-padding">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Waktu</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Mode</th>
                                <th colspan="2" class="text-center">Data</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($transactionHistory as $transaction)
                            <?php $data = json_decode($transaction->data); ?>

                            <tr>
                                <td rowspan="6" class="text-center" style="text-align: center; ">{{ date('H:i', $transaction->created_at/1000) }}</td>
                                <td rowspan="6" class="text-center" style="text-align: center; ">{{ date('j M Y', $transaction->created_at/1000) }}</td>
                                <td rowspan="6" class="text-center"> {{ $transaction->mode }} </td>
                                <td><b>Nama</b></td>
                                <td><b>Sebelum</b></td>
                                <td><b>Sesudah</b></td>
                            </tr>

                            <tr>
                                <td>Kategori</td>
                                <td> {{ empty($data->before) ? '-' : $data->before->category_name }} </td>
                                <td>{{ $data->after->category_name }}</td>
                            </tr>

                            <tr>
                                <td>Tangal</td>
                                <td> {{ empty($data->before) ? '-' : date('j M Y', $data->before->date / 1000) }} </td>
                                <td>{{ date('j M Y', $data->after->date / 1000) }}</td>
                            </tr>

                            <tr>
                                <td>Deskripsi</td>
                                <td> {{ empty($data->before) ? '-' : $data->before->description }} </td>
                                <td>{{ $data->after->description }}</td>
                            </tr>

                            <tr>
                                <td>Pengeluaran</td>
                                <td class="text-danger">{{ empty($data->before) ? '-' : number_format($data->before->spending) }} </td>
                                <td class="text-danger">{{ number_format($data->after->spending) }}</td>
                            </tr>

                            <tr>
                                <td>Pendapatan</td>
                                <td class="text-success"> {{ empty($data->before) ? '-' : number_format($data->before->income) }} </td>
                                <td class="text-success">{{ number_format($data->after->income) }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


</section>
@endsection