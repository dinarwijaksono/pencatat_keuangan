<div class="box">
    <div class="box-header">
        <h3 class="box-title">Buat Transaksi</h3>
    </div><!-- /.box-header -->

    <div class="box-body">
        <div class="form-group">
            <label for="date">Tanggal</label>
            <input type="date" class="form-control" wire:model="date" id="date" value="{{ $time }}">
            @error('date')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <div class="btn-group">
                <button type="button" wire:click="setType('income')" @class(['btn-primary', 'active' => $type == 'income'])>Pemasukan</button>
                <button type="button" wire:click="setType('spending')"
                    @class(['btn-primary', 'active' => $type == 'spending'])>Pengeluaran</button>
            </div>
            @error('type')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="category">Kategori</label>
            <select wire:model="category" class="form-control" id="category">
                <option>--pilih--</option>
                @foreach ($listCategory as $category)
                    @if ($category->type == $type)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
            @error('category')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="value">Jumlah</label>
            <input type="number" wire:model="value" wire:keyup="setNumber" class="form-control" id="value">
            <p>Rp {{ number_format($number) }}</p>
            @error('value')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <input type="text" wire:model.live="description" class="form-control" id="description">
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

    </div> <!-- box-body -->

    <div class="box-footer no-border">
        <div class="flex gap-2">
            <a href="/" class="btn-danger hover:text-white basis-6/12">Batal</a>
            <button type="button" wire:click="doAddItem" class="btn-primary basis-6/12">
                Buat Transaksi</button>
        </div>
    </div>

</div>
