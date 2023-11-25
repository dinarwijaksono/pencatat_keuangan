<section>
    <div class="box-header">
        <h3 class="box-title">{{ date('l, d F Y') }}</h3>
    </div><!-- /.box-header -->

    <div class="box-body table-responsive no-padding" style="margin-bottom: 20px;">
        <table class="table table-hover ">
            <thead>
                <tr class="bg-warning">
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center" colspan="2">Nilai</th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>

                </tr>
            </thead>

            <tbody>

                <?php
                $incomeTotal = 0;
                $spendingTotal = 0;
                ?>

                @foreach ($listTransactionInDay as $transaction)
                <?php
                $incomeTotal += $transaction->income;
                $spendingTotal += $transaction->spending;
                ?>
                <tr>
                    <td class="text-center"><a href="#">{{ $transaction->category_name}}</a></td>
                    <td>{{ $transaction->description }}</td>
                    <td class="text-right text-green">Rp {{number_format($transaction->income)}}</td>
                    <td class="text-right text-red">Rp {{ number_format($transaction->spending) }}</td>
                    <td>
                        <button class="btn btn-xs btn-block btn-primary">Edit</button>
                    </td>
                    <td>
                        <button type="submit" wire:click="doDelete('{{$transaction->code}}')" class="btn btn-xs btn-block btn-danger">Hapus</button>
                    </td>
                </tr>
                @endforeach

            </tbody>

            <tfoot>
                <tr class="bg-warning">
                    <td class="text-right" colspan="2" style="font-weight: bold;">Total</td>
                    <td class="text-right text-green" style="font-weight: bold;">Rp {{ number_format($incomeTotal) }}</td>
                    <td class="text-right text-red" style="font-weight: bold;">Rp {{ number_format($spendingTotal) }} </td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>

        </table>
    </div><!-- /.box-body -->

    <div class="box-header">
        <div class="row ">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <a href="/Transaction/add-item" class="btn btn-block btn-sm bg-green">Tambah transaksi</a>
            </div>
        </div>
    </div>
</section>