<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Transaksi dengan kategori {{ $category->name }}</h3>
    </div>

    <div class="box-body">

        <table class="table table-hover" aria-describedby="table-list-transaction-by-category">
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
                @foreach ($listTransaction as $key)
                    <tr>
                        <td class="text-center">{{ date('j F Y', $key->date / 1000) }}</td>
                        <td>{{ $key->description }} </td>
                        <td class="text-right">
                            {{ number_format($key->income == null ? $key->spending : $key->income) }}
                        <td>
                            <a href="/Transaction/edit/{{ $key->code }}"
                                class="btn btn-success btn-xs btn-block">Edit</a>
                        </td>
                        <td>
                            <button type="button" wire:click="doDelete('{{ $key->code }}')"
                                class="btn btn-danger btn-xs btn-block">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>
