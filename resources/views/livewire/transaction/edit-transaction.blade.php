<div>
    <section class="p-2">
        <h1 class="text-[24px]">Form page</h1>
    </section>

    <section class="bg-white drop-shadow-xl p-2 border rounded border-x-0 border-b-0 border-t-4 border-sky-500 ">

        <h1 class="text-[16px] text-slate-600 mb-3">Edit item</h1>

        <form>

            <div class="mb-3">
                <label class="w-full inline-block mb-1" style="font-family: 'Lato-bold';" for="tanggal">Tanggal</label>
                <input type="date" wire:model="date" class="w-full p-1 border border-zinc-300 h-8" id="tanggal">
                @error('date')
                <p class="text-red-600"><?= $message ?></p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="w-full inline-block mb-1" style="font-family: 'Lato-bold';" for="type">Type</label>
                <select wire:model="type" id="type" class="w-full p-1 border border-zinc-300 bg-white h-8">
                    <option value="spending">Pengeluaran</option>
                    <option value="income">Pemasukan</option>
                </select>
                @error('type')
                <p class="text-red-600"><?= $message ?></p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="w-full inline-block mb-1" style="font-family: 'Lato-bold';" for="type">Kategori</label>
                <select wire:model="category" id="type" class="w-full p-1 border border-zinc-300 bg-white h-8">
                    <?php if ($type == 'spending') : ?>
                        <option value="">---</option>
                        @foreach ($spending as $cat)
                        <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                        @endforeach
                    <?php else : ?>
                        <option value="">---</option>
                        @foreach ($income as $cat)
                        <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                        @endforeach
                    <?php endif ?>
                </select>
                @error('category')
                <p class="text-red-600"><?= $message ?></p>
                @enderror
            </div>

            <div class=" mb-3">
                <label class="w-full inline-block mb-1" style="font-family: 'Lato-bold';" for="judul">Judul</label>
                <input type="text" wire:model="title" class="w-full p-1 border border-zinc-300 h-8" id="judul" placeholder="Judul">
                @error('title')
                <p class="text-red-600"><?= $message ?></p>
                @enderror
            </div>

            <div class=" mb-3">
                <label class="w-full inline-block mb-1" style="font-family: 'Lato-bold';" for="nominal">Nominal</label>
                <input type="text" wire:model="value" class="w-full p-1 border border-zinc-300 h-8" id="nominal" placeholder="Nominal">
                @if($value == null)
                <p class="mt-2 text-green-600"><?= 'Rp. ' . number_format(0) ?></p>
                @endif
                @if($value != null && is_numeric($value))
                <p class="mt-2 text-green-600"><?= 'Rp. ' . number_format($value) ?></p>
                @endif
                @error('value')
                <p class="text-red-600"><?= $message ?></p>
                @enderror
            </div>

            <div class="text-right">
                <a href="/" class="inline-block text-center w-28 bg-red-600 rounded p-1 text-white">Batal</a>
                <button type="button" wire:click="editTransaction" class="w-28 bg-green-600 rounded p-1 text-white">Edit</button>
            </div>

        </form>
    </section>

</div>