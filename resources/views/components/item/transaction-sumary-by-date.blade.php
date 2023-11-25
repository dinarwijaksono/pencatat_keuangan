<table class="table table-hover">
    <tr>
        <th class="text-center">Tanggal</th>
        <th class="text-center">Pemasukan</th>
        <th class="text-center">Pengeluaran</th>
        <th></th>
    </tr>

    @foreach ($transactionSumaryByDate as $transaction)
    <tr>
        <td class="text-center">{{ date('d M Y', $transaction->date / 1000) }}</td>
        <td class="text-right text-green">{{number_format($transaction->total_income)}}</td>
        <td class="text-right text-red">{{number_format($transaction->total_spending)}}</td>
        <td>
            <a class="btn btn-xs bg-green btn-block">Detail</a>
        </td>
    </tr>
    @endforeach
</table>