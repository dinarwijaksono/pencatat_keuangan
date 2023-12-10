<table class="table table-hover">
    <thead>
        <tr>
            <th class="text-center">Tanggal</th>
            <th>Deskripsi</th>
            <th class="text-center">Nilai</th>
            <th></th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($listTransaction as $transaction)
            <tr>
                <td class="text-center">{{ date('j F Y', $transaction->date / 1000) }}</td>
                <td>{{ $transaction->description }} </td>
                <td class="text-right">
                    {{ number_format($transaction->income == null ? $transaction->spending : $transaction->income) }}
                <td>
                    <a href="/Transaction/edit/{{ $transaction->code }}" class="btn btn-success btn-xs btn-block">Edit</a>
                </td>
                <td>
                    <button type="button" wire:click="doDelete('{{ $transaction->code }}')"
                        class="btn btn-danger btn-xs btn-block">Hapus</button>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
