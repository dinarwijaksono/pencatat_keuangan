<section>

    <h3 class="mb-3">Tambah transaksi </h3>

    <div class="input-group mb-2">
        <label for="date">date</label>
        <input type="date" wire:model.live="date" id="date" placeholder="Tanggal" autocomplete="off">
        @error('date')
        <p class="text-danger"><?= $message ?></p>
        @enderror
    </div>

    <div class="input-group mb-2">
        <label for="category">Type <?= $this->type ?></label>
        <select wire:model.live="type" id="category">
            <option value="spending">Pengeluaran</option>
            <option value="income">Pemasukan</option>
        </select>
    </div>

    <div class="input-group mb-2">
        <label for="category">kategori</label>
        <select wire:model.live="category_id" id="category">
            <option>--pilih kategori--</option>
            <?php foreach ($this->listCategory->where('type', $this->type) as $category) : ?>
                <option value="<?= $category->id ?>"><?= $category->name ?></option>
            <?php endforeach ?>
        </select>
        @error('category_id')
        <p class="text-danger"><?= $message ?></p>
        @enderror
    </div>

    <div class="input-group mb-2">
        <label for="item">item</label>
        <input type="text" wire:model.live="item" id="item" placeholder="item" autocomplete="off">
        @error('item')
        <p class="text-danger"><?= $message ?></p>
        @enderror
    </div>

    <div class="input-group mb-2">
        <label for="value">Jumlah</label>
        <input type="text" wire:model.live="value" wire:keyup="setNumber" id="value" placeholder="value" autocomplete="off">
        <p><?= 'Rp ' . number_format($this->number)  ?></p>
        @error('value')
        <p class="text-danger"><?= $message ?></p>
        @enderror
    </div>

    <div class="flex justify-around">
        <div class="basis-3/12">
            <a href="/" class="btn-sm bg-danger">Batal</a>
        </div>
        <div class="basis-3/12">
            <button wire:click="doAddItem" class="btn-sm bg-success">Tambah</button>
        </div>
    </div>

</section>