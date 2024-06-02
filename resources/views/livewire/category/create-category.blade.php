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

        <input type="hidden" wire:model="categoryType">

        <div class="flex">
            <button type="button" wire:click="doChangeTypeToIncome" @class([
                'bg-slate-300' => $categoryType != 'income',
                'bg-primary' => $categoryType == 'income',
                'text-slate-700' => $categoryType != 'income',
                'text-white' => $categoryType == 'income',
                'hover:bg-slate-200' => $categoryType != 'income',
                'basis-1/2',
                'py-1',
                'px-2',
            ])>Pemasukan</button>
            <button type="button" wire:click="doChangeTypeToSpending" @class([
                'bg-slate-300' => $categoryType != 'spending',
                'bg-primary' => $categoryType == 'spending',
                'text-slate-700' => $categoryType != 'spending',
                'text-white' => $categoryType == 'spending',
                'hover:bg-slate-200' => $categoryType != 'spending',
                'basis-1/2',
                'py-1',
                'px-2',
            ])>Pemasukan</button>
        </div>
        @error('categoryType')
            <p class="text-red-500 italic">{{ $message }}</p>
        @enderror

        <div class="box-footer flex justify-end mt-2">
            <div class="basis-2/12">
                <button type="button" wire:click="doAddCategory" class="btn-primary w-full">Kirim</button>
            </div>
        </div>

</section>
