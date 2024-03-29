<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Transaksi</h3>
    </div><!-- /.box-header -->

    <div class="box-body">
        <div class="form-group">
            <label for="date">Tanggal</label>
            <input type="date" class="form-control" wire:model="date" id="date" value="{{ $time }}">
            @error('date')
            <p class="text-red">{{ $message }}</p>
            @enderror
        </div>


        <div class="form-group">
            <div class="radio">
                @if ($type == "spending")
                <label>
                    <input type="radio" wire:model="type" wire:click="setType('spending')" value="spending" checked>
                    pengeluaran
                </label>
                @else
                <label>
                    <input type="radio" wire:model="type" wire:click="setType('spending')" value="spending">
                    pengeluaran
                </label>
                @endif
            </div>
            <div class="radio">
                @if ($type == 'income')
                <label>
                    <input type="radio" wire:model="type" wire:click="setType('income')" value="income" checked>
                    Pemasukan
                </label>
                @else
                <label>
                    <input type="radio" wire:model="type" wire:click="setType('income')" value="income">
                    Pemasukan
                </label>
                @endif
            </div>
            @error('type')
            <p class="text-red">{{ $message }}</p>
            @enderror
        </div>


        <div class="form-group">
            <label>Kategori</label>
            <select wire:model="category_id" class="form-control">
                <option>--pilih--</option>
                @foreach ($listCategory as $category)
                @if ($type === $category->type)
                @if ($category->id == $category_id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
                @endif
                @endforeach
            </select>
            @error('category')
            <p class="text-red">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="value">Jumlah</label>
            <input type="number" wire:model="value" wire:keyup="setNumber" class="form-control" id="value">
            <p>Rp {{ number_format($number) }}</p>
            @error('value')
            <p class="text-red">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <input type="text" wire:model="description" class="form-control" id="description" value="{{ $description }}">
            @error('description')
            <p class="text-red">{{ $message }}</p>
            @enderror
        </div>

    </div> <!-- box-body -->

    <div class="box-footer no-border">
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <button type="button" wire:click="doUpdate" class="btn btn-block btn-sx btn-primary">Edit Transaksi</button>
            </div>
        </div>
    </div>

</div>