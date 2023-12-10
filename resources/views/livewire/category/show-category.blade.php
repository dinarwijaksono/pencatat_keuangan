<section>

    <div class="box-header">
        <h3 class="box-title">List kategori</h3>
    </div><!-- /.box-header -->

    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr>
                <th class="text-center">No</th>
                <th>Nama</th>
                <th class="text-center">Type</th>
                <th class="text-center">Dibuat</th>
                <th></th>
            </tr>

            @foreach ($listCategory as $category)
                <tr>
                    <td class="text-center"> {{ $loop->iteration }} </td>
                    <td> <a href="/Category/detail/{{ $category->code }}">{{ $category->name }}</a> </td>
                    <td class="text-center">
                        @if ($category->type == 'income')
                            <span class="label label-success">Pemasukan</span>
                        @else
                            <span class="label label-danger">Pengeluaran</span>
                        @endif
                    </td>
                    <td class="text-center">{{ date(' h:i, d M Y', $category->created_at / 1000) }}</td>
                    <td class="text-center">
                        <button type="button" wire:click="doDeleteByCode('{{ $category->code }}')"
                            class="btn btn-danger btn-xs">Hapus</button>
                    </td>
                </tr>
            @endforeach

        </table>
    </div><!-- /.box-body -->
</section>
