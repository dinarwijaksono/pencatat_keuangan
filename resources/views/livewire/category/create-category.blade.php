<div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Buat kategori</h3>
        </div><!-- /.box-header -->

        <!-- form start -->
        <form role="form">
            <div class="box-body">
                <div class="form-group">
                    <label for="categoryName">Nama kategori</label>
                    <input type="text" wire:model="categoryName" class="form-control" id="categoryName" placeholder="Nama kategori">
                    @error('categoryName')
                    <p class="text-danger"> {{ $message }} </p>
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
                    <p class="text-danger"> {{ $message }} </p>
                    @enderror
                </div>
            </div><!-- /.box-body -->

            <div class="box-footer clearfix no-border">
                <button type="button" wire:click="doAddCategory" class="btn btn-sm btn-primary pull-right">Submit</button>
            </div>

        </form>
    </div><!-- /.box -->
</div>