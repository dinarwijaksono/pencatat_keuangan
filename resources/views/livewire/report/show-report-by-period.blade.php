<section>
    <div class="box-header">
        <h3 class="box-title">Pemasukan vs Pengeluaran (Semua periode)</h3>

        <div class="row" style="margin-top: 10px;">

            <div class="col-md-4">
                @if (count($listPeriod) !== 0)
                    <button type="button" wire:click="doPrev" class="btn btn-sm btn-primary btn-block">
                        Sebelumnya</button>
                @endif
            </div>

            <div class="col-md-4">

                <p class="text-center">{{ count($listPeriod) == 0 ? 'Tidak ada periode' : $listPeriod[$curentIndex] }}
                </p>
            </div>

            <div class="col-md-4">
                @if (count($listPeriod) !== 0)
                    <button type="button" wire:click="doNext"
                        class="btn btn-sm btn-primary btn-block">Selanjutnya</button>
                @endif
            </div>

        </div>

    </div><!-- /.box-header -->

    <div class="box-body">

        @if (count($listPeriod) !== 0)
            <div class="row">
                <div class="col-md-6">

                    <h4>Pemasukan</h4>

                    <table class="table" aria-describedby="my-table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Kategori</th>
                                <th scope="col" class="text-center">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            $grandTotalIncome = 0; ?>
                            @foreach ($listTransaction as $transaction)
                                @if ($transaction->total_income != 0)
                                    <?php $grandTotalIncome += $transaction->total_income; ?>
                                    <tr>
                                        <td class="text-center"><?= $i++ ?></td>
                                        <td><?= $transaction->category_name ?> </td>
                                        <td class="text-right text-success">
                                            <?= number_format($transaction->total_income) ?>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <td class="text-right" colspan="2">Total</td>
                                <td class="text-right text-success"><?= number_format($grandTotalIncome) ?>
                                </td>
                            </tr>
                        </tfoot>

                    </table>

                </div>

                <div class="col-md-6">

                    <h4>Pengeluaran</h4>

                    <table class="table" aria-describedby="my-table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Kategori</th>
                                <th scope="col" class="text-center">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            $grandTotalSpending = 0; ?>
                            @foreach ($listTransaction as $transaction)
                                @if ($transaction->total_spending != 0)
                                    <?php $grandTotalSpending += $transaction->total_spending; ?>
                                    <tr>
                                        <td class="text-center"><?= $i++ ?></td>
                                        <td><?= $transaction->category_name ?> </td>
                                        <td class="text-right text-danger">
                                            <?= number_format($transaction->total_spending) ?> </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <td class="text-right" colspan="2">Total</td>
                                <td class="text-right text-danger"><?= number_format($grandTotalSpending) ?>
                                </td>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        @endif
    </div>
</section>
