<section class="box p-3">

    <div class="box-header">
        <h3 class="box-title">List kategori</h3>
    </div><!-- /.box-header -->

    <div class="box-body ">
        <table class="table-simple w-full" aria-describedby="table-list-category">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="text-center hidden md:block">No</th>
                    <th>Nama</th>
                    <th class="text-center">Type</th>
                    <th class="text-center hidden md:block">Dibuat</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($listCategory as $category)
                    <tr class="hover:bg-slate-200">
                        <td class="text-center hidden md:block"> {{ $loop->iteration }} </td>
                        <td> <a href="/Category/detail/{{ $category->code }}">{{ $category->name }}</a> </td>
                        <td class="text-center">
                            <span
                                @class([
                                    'bg-danger' => $category->type == 'spending',
                                    'bg-success' => $category->type == 'income',
                                    'text-white',
                                    'px-2',
                                    'rounded',
                                    'text-[13px]',
                                ])>{{ $category->type == 'spending' ? 'Pengeluaran' : 'Pemasukan' }}</span>
                        </td>
                        <td class="text-center hidden md:block">{{ date(' h:i, d M Y', $category->created_at / 1000) }}
                        </td>
                        <td class="text-center">
                            <button type="button" wire:click="doDeleteByCode('{{ $category->code }}')"
                                class="w-full bg-danger text-white text-[13px] px-2 py-1">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- /.box-body -->
</section>
