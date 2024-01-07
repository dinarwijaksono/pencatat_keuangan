<section>
    <div class="box-header">
        <h3 class="box-title">Pemasukan vs Pengeluaran (Semua periode)</h3>

        <div class="row" style="margin-top: 10px;">

            <div class="col-md-4">
                <button type="button" wire:click="doPrev" class="btn btn-sm btn-primary btn-block">Sebelumnya</button>
            </div>

            <div class="col-md-4">

                <p class="text-center">{{ $listPeriod[$curentIndex] }} </p>
            </div>

            <div class="col-md-4">
                <button type="button" wire:click="doNext" class="btn btn-sm btn-primary btn-block">Sebelumnya</button>
            </div>

        </div>

    </div><!-- /.box-header -->

    <div class="box-body">

        <div class="row">
            <div class="col-md-6">

                <h4>Pemasukan</h4>

                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Nilai</th>
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
                                    <td class="text-right text-success"><?= number_format($transaction->total_income) ?>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th class="text-right" colspan="2">Total</th>
                            <th class="text-right text-success"><?= number_format($grandTotalIncome) ?>
                            </th>
                        </tr>
                    </tfoot>

                </table>

            </div>

            <div class="col-md-6">

                <h4>Pengeluaran</h4>

                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Nilai</th>
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
                            <th class="text-right" colspan="2">Total</th>
                            <th class="text-right text-danger"><?= number_format($grandTotalSpending) ?>
                            </th>
                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>

    </div>
</section>
