<section class="box">
    <div class="box-header">
        <h3 class="box-title">Buat kategori</h3>
    </div>

    <div class="box-body">
        <div class="form-group">
            <label for="categoryName">Nama kategori</label>
            <input type="text" wire:model="categoryName" id="categoryName" placeholder="Nama kategori">
            @error('categoryName')
                <p class="error"> {{ $message }} </p>
            @enderror
        </div>

        <div class="form-group">
            <label>
                <input type="radio" wire:model="categoryType" value="income"> Pemasukan
            </label>
            <label>
                <input type="radio" wire:model="categoryType" value="spending"> Pengeluaran
            </label>
            @error('categoryType')
                <p class="error"> {{ $message }} </p>
            @enderror
        </div>
    </div>

    <div class="box-footer flex justify-end">
        <div class="basis-2/12">
            <button type="button" wire:click="doAddCategory" class="btn-primary w-full">Kirim</button>
        </div>
    </div>

</section>
