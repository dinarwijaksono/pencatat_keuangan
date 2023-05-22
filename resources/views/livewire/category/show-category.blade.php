<section>

    <!-- <div class="flex mb-2 text-[14px] mt-3 gap-1">
        <div class="basis-1/3">
            <button wire:click="changeToIncome" class="btn bg-primary">Pemasukan</button>
        </div>

        <div class="basis-1/3">
            <button wire:click="changeToSpending" class="btn bg-primary">Pengeluaran</button>
        </div>

        <div class="basis-1/3">
            <button wire:click="" class="btn bg-success">Semua</button>
        </div>
    </div> -->

    <?php if (session()->has('deleteCategorySuccess')) : ?>
        <div class="alert bg-success mb-2">
            <p><?= session()->get('deleteCategorySuccess'); ?></p>
        </div>
    <?php endif ?>

    <div>
        <table class="w-full main">
            <tr>
                <th class="w-1/12">No</th>
                <th class="w-auto">Nama</th>
                <th class="w-2/12">Jenis</th>
                <th class="w-2/12">Dibuat</th>
                <!-- <th class="w-2/12">Diedit</th> -->
                <th class="w-2/12"></th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach ($this->listCategory as $category) : ?>
                <tr>
                    <td class="text-center"><?= $i++; ?></td>
                    <td><?= $category->name ?></td>
                    <?php if ($category->type == 'income') : ?>
                        <td class="text-center"><?= $category->type ?></td>
                    <?php else : ?>
                        <td class="text-center text-danger"><?= $category->type ?></td>
                    <?php endif ?>
                    <td class="text-center"><?= date('d M Y', $category->created_at / 1000) ?></td>
                    <!-- <td class="text-center">12 Maret 2022</td> -->
                    <td class="text-center">
                        <div class="flex gap-1 row p-1">
                            <!-- <div class="basis-1/2">
                                <button class="btn bg-success">edit</button>
                            </div> -->

                            <!-- <div class="W-full"> -->
                            <button wire:click="doDeleteByCode('<?= $category->code ?>')" class="btn bg-danger">Hapus</button>
                            <!-- </div> -->

                        </div>
                    </td>
                </tr>
            <?php endforeach ?>

        </table>
    </div>
</section>