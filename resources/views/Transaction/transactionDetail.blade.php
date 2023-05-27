@extends('layouts.main')

@section('main-section')
<section class="box">
    <h3 class="mb-2">Transaction detail</h3>

    <?php if (session()->has('deleteTransactionSuccess')) : ?>
        <div class="alert bg-danger mb-2">
            <p><?= session()->get('deleteTransactionSuccess') ?></p>
        </div>
    <?php endif ?>

    <table class="w-full text-[14px] mb-3" cellpading="1">
        <tr>
            <td><?= date('d M Y', $date / 1000) ?></td>
            <td class="text-end text-success"><?= 'Rp ' . number_format($transactionInDate['incomeTotal']) ?></td>
        </tr>
        <tr class="border-b-2 border-slate-500">
            <td></td>
            <td class="text-end text-danger"><?= 'Rp ' . number_format($transactionInDate['spendingTotal']) ?></td>
        </tr>
    </table>


    <table class="w-full text-[14px] mb-6">
        <?php foreach ($transactionInDate['listTransaction'] as $t) : ?>
            <tr class="border-b border-slate-200">
                <td class="w-auto"><?= $t->item ?></td>
                <?php if ($t->type == 'income') : ?>
                    <td class="w-auto text-end text-success"><?= 'Rp ' . number_format($t->value) ?></td>
                <?php else : ?>
                    <td class="w-auto text-end text-danger"><?= 'Rp ' . number_format($t->value) ?></td>
                <?php endif ?>
                <td class="w-1/12">
                    <div class="flex gap-1 p-1">
                        <div class="basis-1/2">
                            <a class="btn-sm rounded-sm bg-success">Edit</a>
                        </div>
                        <div class="basis-1/2">
                            <form action="/Transaction/delete/<?= $t->id ?>/<?= $date ?>" method="post">
                                @csrf @method('delete')

                                <button type="submit" class="btn-sm rounded-sm bg-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </table>

    <div class="flex justify-center gap-2 mb-2">
        <div class="basis-1/4">
            <a href="/" class="btn-sm bg-danger rounded">Kembali</a>
        </div>

        <div class="basis-1/4">
            <a href="/Transaction/addItem/<?= $date / 1000 ?>" class="btn-sm bg-success rounded">Tambah</a>
        </div>
    </div>

</section>
@endsection