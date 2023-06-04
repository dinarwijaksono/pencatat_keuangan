@extends('layouts.main')

@section('main-section')
<section class="box">
    <h3 class="mb-2">Saldo</h3>
    <div class="flex">
        <div class="basis-1/2">
            <table class="main w-full">
                <tr class="border-r border-l border-slate-400">
                    <td class="w-auto">Total pemasukan</td>
                    <td class="text-end text-success"><?= 'Rp ' .  number_format($transactionTotal['incomeTotal']) ?></td>
                </tr>
                <tr class="border-r border-l border-slate-400">
                    <td>Total pengeluaran</td>
                    <td class="text-end text-danger"><?= 'Rp ' . number_format($transactionTotal['spendingTotal']) ?></td>
                </tr>
                <tr class="border-r border-l border-slate-400">
                    <td>Selisih</td>
                    <td class="text-end"><?= 'Rp ' . number_format($transactionTotal['incomeTotal'] - $transactionTotal['spendingTotal']) ?></td>
                </tr>
            </table>
        </div>
    </div>
</section>

<section class="box">
    <h3 class="mb-2">Total pemasukan dan pengeluaran perkategori</h3>

    <a href="#" class="btn-link my-2 text-end">Lihat periode lainnya</a>

    <h4>Periode juni 2022</h4>

    <div class="flex gap-2">
        <div class="basis-1/2">

            <h4>Pemasukan</h4>

            <table class="main w-full">
                <tr class="border-r border-l border-slate-400">
                    <th class="w-auto">Kategori</th>
                    <th class="w-auto">Value</th>
                </tr>
                <?php foreach ($totalCategoryList->where('type', 'income') as $key) : ?>
                    <tr class="border-r border-l border-slate-400">
                        <td><?= $key['category_name'] ?></td>
                        <td class="text-end"><?= 'Rp ' . number_format($key['total']) ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>

        <div class="basis-1/2">

            <h4>pengeluaran</h4>

            <table class="main w-full">
                <tr class="border-r border-l border-slate-400">
                    <th class="w-auto">Kategori</th>
                    <th class="w-auto">Value</th>
                </tr>
                <?php foreach ($totalCategoryList->where('type', 'spending') as $key) : ?>
                    <tr class="border-r border-l border-slate-400">
                        <td><?= $key['category_name'] ?></td>
                        <td class="text-end"><?= 'Rp ' . number_format($key['total']) ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>

    </div>

</section>
@endsection