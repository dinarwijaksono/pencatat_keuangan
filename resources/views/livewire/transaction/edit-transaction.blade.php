<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Transaksi</h3>
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
            <label for="categoryId">Kategori</label>
            <select wire:model="categoryId" class="form-control">
                <option>--pilih--</option>
                @foreach ($listCategory as $category)
                    @if ($type === $category->type)
                        @if ($category->id == $categoryId)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endif
                @endforeach
            </select>
            @error('categoryId')
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
            <input type="text" wire:model="description" class="form-control" id="description"
                value="{{ $description }}">
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

    </div> <!-- box-body -->

    <div class="box-footer flex gap-8">
        <a href="/" class="btn-danger basis-6/12 hover:text-white">Batal</a>
        <button type="button" wire:click="doUpdate" class="btn-primary basis-6/12">Edit
            Transaksi</button>
    </div>
</div>

</div>
