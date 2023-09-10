<section>
    <h3 class="mb-2">Buat Kategori Baru</h3>

    <?php if (session()->has('createCategorySuccess')) :  ?>
        <div class="alert bg-info">
            <p><?= session()->get('createCategorySuccess') ?></p>
        </div>
    <?php endif ?>

    <div class="input-group mb-2">
        <label for="name">Nama</label>
        <input type="text" wire:model.live="categoryName" id="name" placeholder="Nama kategori" autocomplete="off">
        @error('categoryName')
        <p class="text-danger"><?= $message ?></p>
        @enderror
    </div>

    <div class="input-group mb-2">
        <label for="type">Jenis</label>
        <select wire:model.live="categoryType" id="type">
            <option>-- Pilih type --</option>
            <option value="income">Pemasukan</option>
            <option value="spending">Pengeluaran</option>
        </select>
        @error('categoryType')
        <p class="text-danger"><?= $message ?></p>
        @enderror
    </div>

    <div class="w-full p-2 flex justify-end">
        <div class="basis-3/12">
            <button type="button" wire:click="doAddCategory" class="btn bg-primary">Buat kategori</button>
        </div>
    </div>
</section>