<table class="table w-full">
    <tr class="bg-warning">
        <th class="text-center w-3/12 py-1">Tanggal</th>
        <th class="text-center w-3/12 py-1">Pemasukan</th>
        <th class="text-center w-3/12 py-1">Pengeluaran</th>
        <th class="w-3/12"></th>
    </tr>

    @foreach ($transactionSumaryByDate as $transaction)
        <tr class="border-b border-slate-300 hover:bg-slate-200">
            <td class="text-center text-[14px] hidden md:block md:text-[16px] p-1">
                {{ date('j M Y', $transaction->date / 1000) }}</td>
            <td class="text-center text-[14px] md:hidden p-1">{{ date('j-N-y', $transaction->date / 1000) }}</td>

            <td class="text-right text-primary text-[14px] md:text-[16px] p-1">
                {{ $transaction->total_income == 0 ? '-' : number_format($transaction->total_income) }}
            </td>

            <td class="text-right text-danger text-[14px] md:text-[16px] p-1">
                {{ $transaction->total_spending == 0 ? '-' : number_format($transaction->total_spending) }}</td>
            <td>
                <a href="/Transaction/detail/{{ $transaction->date }}" class="btn-success text-[14px] p-1 ">Detail</a>
            </td>
        </tr>
    @endforeach
</table>
