<section class="box">
    <div class="box-header">
        <h3 class="box-title">Pemasukan vs Pengeluaran</h3>

        <div class="flex">

            <div class="basis-4/12">
                @if (count($listPeriod) !== 0)
                    <button type="button" wire:click="doPrev" class="btn-primary w-full">Sebelumnya</button>
                @endif
            </div>

            <div class="basis-4/12">
                <p class="text-center">{{ count($listPeriod) == 0 ? 'Tidak ada periode' : $listPeriod[$curentIndex] }}
                </p>
            </div>

            <div class="basis-4/12">
                @if (count($listPeriod) !== 0)
                    <button type="button" wire:click="doNext" class="btn-primary w-full">Selanjutnya</button>
                @endif
            </div>

        </div>

    </div><!-- /.box-header -->

    <div class="box-body mt-4 p-1">

        @if (count($listPeriod) !== 0)
            <div class="md:flex md:gap-2">
                <div class="md:basis-6/12 mb-5">

                    <h4 class="underline">Pemasukan</h4>

                    <table class="table w-full" aria-describedby="my-table">
                        <thead>
                            <tr class="bg-yellow-300 text-slate-600">
                                <th scope="col" class="text-center p-1">Kategori</th>
                                <th scope="col" class="text-center p-1">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $grandTotalIncome = 0; ?>
                            @foreach ($listTransaction->sortByDesc('total_income') as $transaction)
                                @if ($transaction->total_income != 0)
                                    <?php $grandTotalIncome += $transaction->total_income; ?>
                                    <tr class="border-b border-slate-300">
                                        <td class="py-1 px-2"><?= $transaction->category_name ?> </td>
                                        <td class="py-1 px-2 text-right text-success">
                                            <?= number_format($transaction->total_income) ?>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <td class="py-1 px-2 text-right font-bold">Total</td>
                                <td class="py-1 px-2 text-right font-bold text-success">
                                    <?= number_format($grandTotalIncome) ?>
                                </td>
                            </tr>
                        </tfoot>

                    </table>

                </div>

                <div class="md:basis-6/12">

                    <h4 class="underline">Pengeluaran</h4>

                    <table class="table w-full" aria-describedby="my-table">
                        <thead>
                            <tr class="bg-yellow-300 text-slate-600">
                                <th scope="col" class="text-center p-1">Kategori</th>
                                <th scope="col" class="text-center p-1">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $grandTotalSpending = 0; ?>
                            @foreach ($listTransaction->sortByDesc('total_spending') as $transaction)
                                @if ($transaction->total_spending != 0)
                                    <?php $grandTotalSpending += $transaction->total_spending; ?>
                                    <tr class="border-b border-slate-300">
                                        <td class="px-2 py-1"><?= $transaction->category_name ?> </td>
                                        <td class="px-2 py-1 text-right text-danger">
                                            <?= number_format($transaction->total_spending) ?> </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <td class="py-1 px-2 text-right font-bold">Total</td>
                                <td class="py-1 px-2 text-right font-bold text-danger">
                                    <?= number_format($grandTotalSpending) ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>

            <div class="mt-4">
                <h4 class="underline">Selisih</h4>

                <table class="w-full" aria-describedby="my-table">
                    <thead>
                        <tr class="bg-yellow-300 text-slate-600">
                            <th class="p-1">Type</th>
                            <th class="p-1">Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="border-b border-slate-300">
                            <td class="py-1 px-2">Pemasukan</td>
                            <td class="py-1 px-2 text-right text-success">
                                <?= number_format($grandTotalIncome) ?>
                            </td>
                        </tr>

                        <tr class="border-b border-slate-300">
                            <td class="py-1 px-2">Pengeluaran</td>
                            <td class="py-1 px-2 text-right text-danger">
                                <?= number_format($grandTotalSpending) ?>
                            </td>
                        </tr>

                        <tr>
                            <td class="py-1 px-2">Selisih</td>
                            <td @class([
                                'text-success' => $grandTotalIncome > $grandTotalSpending,
                                'text-danger' => $grandTotalIncome < $grandTotalSpending,
                                'py-1',
                                'px-2',
                                'text-right',
                                'font-bold',
                            ])>
                                <?= number_format($grandTotalIncome - $grandTotalSpending) ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        @endif
    </div>
</section>
