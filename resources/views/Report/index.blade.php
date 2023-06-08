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

    <!-- <a href="#" class="btn-link my-2 text-end">Lihat periode lainnya</a> -->

    <h4>Periode <?= date('M-Y', time()) ?></h4>

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

<section class="box">

    <h4 class="mb-2">Income perhari (periode <?= date('M-Y', time()) ?>)</h4>

    <!-- <a href="#" class="btn-link text-end">Lihat periode lainnya</a> -->

    <div class="border w-full ">
        <canvas id="chartIncome"></canvas>
    </div>

</section>

<script src="/Asset/chartjs/chart.js"></script>
<script>
    let ajax = new XMLHttpRequest();
    ajax.open('POST', "/api/Report/showListTransaction");

    ajax.onload = function() {
        let response = JSON.parse(ajax.responseText);

        const chartIncome = document.getElementById('chartIncome');

        new Chart(chartIncome, {
            type: 'bar',
            data: {
                labels: response.data.labels,
                datasets: [{
                    label: '# of Votes',
                    data: response.data.value,
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    }

    let form = new URLSearchParams();
    form.append('username', "<?= session()->get('username') ?>");
    form.append('period', "<?= date('M-Y', time()) ?>");
    form.append('type', 'income');

    ajax.send(form);
</script>

<section class="box">

    <h4 class="mb-2">pengeluaran perhari (periode <?= date('M-Y', time()) ?>)</h4>

    <!-- <a href="#" class="btn-link text-end">Lihat periode lainnya</a> -->

    <div class="border w-full ">
        <canvas id="chartSpending"></canvas>
    </div>

</section>

<script>
    let ajax2 = new XMLHttpRequest();
    ajax2.open('POST', "/api/Report/showListTransaction");

    ajax2.onload = function() {
        let response = JSON.parse(ajax2.responseText);

        const chartSpending = document.getElementById('chartSpending');

        new Chart(chartSpending, {
            type: 'bar',
            data: {
                labels: response.data.labels,
                datasets: [{
                    label: '# of Votes',
                    data: response.data.value,
                    borderWidth: 1,
                    backgroundColor: 'rgb(220, 150, 150)'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    }

    let form2 = new URLSearchParams();
    form2.append('username', "<?= session()->get('username') ?>");
    form2.append('period', "<?= date('M-Y', time()) ?>");
    form2.append('type', 'spending');

    ajax2.send(form2);
</script>

@endsection