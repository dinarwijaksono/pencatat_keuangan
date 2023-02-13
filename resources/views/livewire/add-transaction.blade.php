<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Tambah Item</h3>
    </div><!-- /.box-header -->

    <form>
        <div class="box-body">

            <div class="form-group">
                <label>Tanggal</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" wire:model="date" class="form-control" value="<?= old('date') ?>" />
                </div><!-- /.input group -->
                @error('date')
                <p class="text-danger"><?= $message ?></p>
                @enderror
            </div><!-- /.form group -->


            <div class="form-group">
                <label>Type</label>
                <select class="form-control" wire:model="type">
                    <option selected value="">Pilih kategori</option>

                    <option value="income">Pemasukan</option>
                    <option value="spending">Pengeluaran</option>

                </select>
                @error('type')
                <p class="text-danger"><?= $message ?></p>
                @enderror
            </div>


            <div class="form-group">
                <label>Kategori</label>
                <select class="form-control" wire:model="category">
                    <option selected value="">Pilih kategori</option>
                    @foreach ($listCategory as $category)
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    @endforeach
                </select>
                @error('category')
                <p class="text-danger"><?= $message ?></p>
                @enderror
            </div>

            <div class="form-group">
                <label for="value">Judul</label>
                <input type="text" wire:model="title" class="form-control " id="value" placeholder="Judul" autocomplete="off">
                @error('title')
                <p class=" text-danger"><?= $message ?></p>
                @enderror
            </div>

            <div class="form-group">
                <label for="value">Nominal</label>
                <input type="text" wire:model="value" class="form-control text-right" style="padding-right: 10px;" id="value" placeholder="Nominal" value="<?= old('value') ?>" autocomplete="off">
                @if($value == null)
                <p class="text-success"><?= 'Rp ' . number_format(0) ?></p>
                @endif
                @if($value != null && is_numeric($value))
                <p class="text-success"><?= 'Rp ' . number_format($value) ?></p>
                @endif
                @error('value')
                <p class="text-danger"><?= $message ?></p>
                @enderror
            </div>

            <div class="box-footer text-right">
                <button type="button" wire:click="addTransaction" class="btn btn-sm btn-primary">Tambah</button>
            </div>

        </div>
    </form>

</div>