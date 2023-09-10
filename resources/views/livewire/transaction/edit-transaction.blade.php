<section>
    <h3 class="mb-3">Edit transaksi</h3>

    <div class="input-group mb-2">
        <label for="date">Tanggal</label>
        <input type="date" wire:model.live="date" id="date">
        @error('date')
        <p class="text-danger"><?= $message ?></p>
        @enderror
    </div>

    <div class="input-group mb-2">
        <label for="category">Type</label>
        <?php $types = [
            [
                'name' => 'income',
                'display' => 'pemasukan'
            ],
            [
                'name' => 'spending',
                'display' => 'pengeluaran'
            ]
        ] ?>
        <select wire:model.live="type" id="category">
            <?php foreach ($types as $ty) : ?>
                <?php if ($ty['name'] == $type) : ?>
                    <option value="<?= $ty['name'] ?>" selected><?= $ty['display'] ?></option>
                <?php else :  ?>
                    <option value="<?= $ty['name'] ?>"><?= $ty['display'] ?></option>
                <?php endif ?>
            <?php endforeach ?>
        </select>
        @error('type')
        <p class="text-danger"><?= $message ?></p>
        @enderror
    </div>

    <div class="input-group mb-2">
        <label for="category">kategori</label>
        <select name="category" id="category">
            <option>--Pilih kategori--</option>
            <?php foreach ($listCategory->where('type', $type) as $category) : ?>
                <?php if ($category->id == $category_id) : ?>
                    <option value="<?= $category->id ?>" selected><?= $category->name ?></option>
                <?php else : ?>
                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                <?php endif ?>
            <?php endforeach ?>
        </select>
        @error('category_id')
        <p class="text-danger"><?= $message ?></p>
        @enderror
    </div>

    <div class="input-group mb-2">
        <label for="item">item</label>
        <input type="text" wire:model.live="item" id="item" placeholder="item">
        @error('item')
        <p class="text-danger"><?= $message ?></p>
        @enderror
    </div>

    <div class="input-group mb-2">
        <label for="value">Jumlah</label>
        <input type="number" wire:model.live="value" id="value" placeholder="value">
        <?php if (is_numeric($value)) : ?>
            <p><?= 'Rp ' . number_format($value) ?></p>
        <?php endif ?>
        @error('value')
        <p class="text-danger"><?= $message ?></p>
        @enderror
    </div>

    <div class="flex justify-around">
        <div class="basis-3/12">
            <a href="/" class="btn-sm bg-danger">Batal</a>
        </div>
        <div class="basis-3/12">
            <button wire:click="doUpdate" class="btn-sm bg-success">Edit</button>
        </div>
    </div>

</section>