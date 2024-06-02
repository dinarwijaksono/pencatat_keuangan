<section class="box">
    <div class="box-header">
        <p class="underline">{{ date('l, d F Y', $time / 1000) }}</p>
    </div>

    <div class="box-body overflow-auto">
        <table class="w-[600px] md:w-full ">
            <thead>
                <tr>
                    <th class="text-center w-3/12">Kategori - Deskripsi</th>
                    <th class="text-center w-3/12" colspan="2">Nilai</th>
                    <th class="text-center w-3/12"></th>
                    <th class="text-center w-3/12"></th>

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
                    <tr class="border-b border-slate-500">
                        <td><a
                                href="/Category/detail/{{ $transaction->category_code }}">{{ $transaction->category_name }}</a>
                            - {{ $transaction->description }}
                        </td>

                        <td class="text-right text-success text-[14px]">
                            {{ $transaction->income == 0 ? '' : number_format($transaction->income) }}
                        </td>

                        <td class="text-right text-danger text-[14px]">
                            {{ $transaction->spending == 0 ? '' : number_format($transaction->spending) }}
                        </td>

                        <td class="p-1">
                            <a href="/Transaction/edit/{{ $transaction->code }}"
                                class="text-[14px] btn-primary w-full">Edit</a>
                        </td>

                        <td class="p-1">
                            <button type="submit" wire:click="doDelete('{{ $transaction->code }}')"
                                class="text-[14px] btn-danger w-full">Hapus</button>
                        </td>
                    </tr>
                @endforeach

            </tbody>

            <tfoot>
                <tr class="bg-warning text-white font-bold">
                    <td class="text-right py-2">Total</td>

                    <td class="text-right text-success text-[14px]">
                        {{ $incomeTotal == 0 ? '' : number_format($incomeTotal) }}
                    </td>

                    <td class="text-right text-danger text-[14px]">
                        {{ $spendingTotal == 0 ? '' : number_format($spendingTotal) }}
                    </td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>

        </table>
    </div><!-- /.box-body -->

    <div class="box-header mt-8">
        <div>
            <a href="/Transaction/add-item/{{ $time }}" class="btn-primary ">
                Tambah transaksi</a>
        </div>
    </div>
    </div>
</section>
