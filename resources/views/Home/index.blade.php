@extends('layouts.main')

@section('main-section')
<section class="box">
    <h3 class="mb-2">Pencatat Keuangan</h3>

    <?php if (session()->has('createTransactionSuccess')) : ?>
        <div class="alert bg-info mb-2">
            <p><?= session()->get('createTransactionSuccess') ?></p>
        </div>
    <?php endif ?>

    <?php if (session()->has('deleteTransactionSuccess')) : ?>
        <div class="alert bg-danger mb-2">
            <p><?= session()->get('deleteTransactionSuccess') ?></p>
        </div>
    <?php endif ?>

    <table class="w-full text-[14px] mb-3" cellpading="1">
        <tr>
            <td><?= date('j M Y', time()) ?></td>
            <td class="text-end text-success"><?= 'Rp' . number_format($transactionToday['incomeTotal']) ?></td>
        </tr>
        <tr class="border-b-2 border-slate-500">
            <td></td>
            <td class="text-end text-danger"><?= 'Rp' . number_format($transactionToday['spendingTotal']) ?></td>
        </tr>
    </table>


    <table class="w-full text-[14px] mb-6">
        <?php foreach ($transactionToday['listTransaction'] as $t) : ?>
            <tr class="border-b border-slate-200">
                <td><?= $t->item ?></td>
                <?php if ($t->type == 'income') : ?>
                    <td class="text-end text-success"><?= 'Rp ' . number_format($t->value) ?></td>
                <?php else : ?>
                    <td class="text-end text-danger"><?= 'Rp ' . number_format($t->value) ?></td>
                <?php endif ?>
                <td class="w-1/12">
                    <div class="flex gap-1 p-1">
                        <div class="basis-1/2">
                            <a class="btn-sm rounded-sm bg-success">Edit</a>
                        </div>
                        <div class="basis-1/2">
                            <form action="/Transactions/delete/<?= $t->id ?>" method="post">
                                @csrf @method('delete')
                                <button class="btn-sm rounded-sm bg-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </table>

    <div class="flex justify-center">
        <div class="basis-1/3">
            <a href="/Transaction/addItem/<?= time() ?>" class="btn-sm bg-success rounded">Tambah</a>
        </div>
    </div>

</section>

<section class="box">

    <table class="text-[14px] w-full mb-8">
        <?php foreach ($list_transaction_not_today as $t) : ?>
            <tr>
                <td rowspan="2" class="text-center bg-green-200 w-3/12 border-t border-l border-b border-slate-400"><?= date('d M Y', $t['date'] / 1000) ?></td>
                <td class="w-2/12 border-t border-slate-400 px-1">Pemasukan</td>
                <td class="text-center w-1/12 border-t border-slate-400">:</td>
                <td class="w-auto text-success text-end px-3 border-t border-slate-400"><?= 'Rp ' . $t['income_total'] ?></td>
                <td rowspan="2" class="p-2 w-2/12 border-t border-r border-b border-slate-400">
                    <a href="/" class="btn-sm bg-success rounded">Detail</a>
                </td>
            </tr>
            <tr>
                <td class="w-2/12 border-b border-slate-400 px-1">Pengeluaran</td>
                <td class="text-center w-1/12 border-b border-slate-400">:</td>
                <td class="w-auto text-danger text-end px-3 border-b border-slate-400"><?= 'Rp ' . $t['spending_total'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- <div>
        <ul class=" text-center">
            <li class="inline-block"><button class="btn-sm mx-1 bg-success">Sebelumnya</button></li>
            <li class="inline-block"><button class="btn-sm mx-1 bg-gray-500 font-bold">1</button></li>
            <li class="inline-block"><button class="btn-sm mx-1 bg-success">Selanjutnya</button></li>
        </ul>
    </div> -->

</section>
@endsection