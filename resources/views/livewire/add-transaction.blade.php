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

                    <option value="spending">Pengeluaran</option>
                    <option value="income">Pemasukan</option>

                </select>
                @error('type')
                <p class="text-danger"><?= $message ?></p>
                @enderror
            </div>


            <div class="form-group">
                <label>Kategori</label>
                <select class="form-control" wire:model="category">

                    <?php if ($type == 'spending') : ?>
                        <option selected value="">---</option>
                        @foreach ($spending as $cat)
                        <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                        @endforeach
                    <?php else : ?>
                        <option selected value="">---</option>
                        @foreach ($income as $cat)
                        <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                        @endforeach
                    <?php endif ?>

                </select>
                @error('category')
                <p class="text-danger"><?= $message ?></p>
                @enderror
            </div>

            <div class="form-group ">
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
                <a href="/" class="btn btn-sm btn-danger">Kembali</a>
                <button type="button" wire:click="addTransaction" class="btn btn-sm btn-primary">Tambah</button>
            </div>

        </div>
    </form>

</div>