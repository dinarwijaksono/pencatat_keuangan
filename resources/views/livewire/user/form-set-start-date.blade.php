<section class="box p-4 border-l-4 border-green-700">
    <div class="box-header mb-4">
        <h3>Tanggal Awal Periode</h3>
    </div>

    <div class="box-body">

        <div class="form-group">
            <label for="startDate">Tanggal awal</label>

            <select wire:model="startDate" id="startDate">
                @for ($i = 1; $i < 29; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>

            @error('startDate')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group flex justify-end">
            <div class="basis-2/12">
                <button type="submit" wire:click="doSetStartDate" class="btn-primary w-full">Simpan</button>
            </div>
        </div>

    </div>
</section>
