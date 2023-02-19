<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Edit Kategori</h3>
    </div><!-- /.box-header -->


    @if (session()->has('updateFailed'))
    <div class="box-body">
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= session('updateFailed') ?>
        </div>
    </div>
    @endif

    <form>
        @csrf

        <div class="box-body">
            <div class="form-group">
                <label for="name">Nama katerogi</label>
                <input type="text" wire:model="name" value="<?= $name ?>" class="form-control" id="name" placeholder="Nama kategori" autocomplete="off">
                @error('name')
                <p class="text-danger"><?= $message ?></p>
                @enderror
            </div>

            <div class="form-group">
                <label>Type</label>
                <select class="form-control disable" disabled>
                    @if ($type == 'spending')
                    <option>Pemasukan</option>
                    @else
                    <option>Pengeluaran</option>
                    @endif
                </select>
            </div>

        </div><!-- /.box-body -->

        <div class="box-footer ">
            <button type="button" wire:click="edit" class="btn btn-primary">Edit kategori</button>
        </div>
    </form>
</div><!-- /.box -->