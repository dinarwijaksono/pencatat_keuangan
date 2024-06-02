<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Transaksi dengan kategori {{ $category->name }}</h3>
    </div>

    <div class="box-body overflow-scroll">

        <table class="table-simple w-[600px] md:w-full" aria-describedby="table-list-transaction-by-category">
            <thead>
                <tr>
                    <th class="w-3/12 text-center">Tanggal</th>
                    <th class="w-auto">Deskripsi</th>
                    <th class="w-2/12 text-center">Nilai</th>
                    <th class="w-2/12"></th>
                    <th class="w-2/12"></th>
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
                                class="btn-success w-full text-[14px]">Edit</a>
                        </td>
                        <td>
                            <button type="button" wire:click="doDelete('{{ $key->code }}')"
                                class="btn-danger w-full">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>
