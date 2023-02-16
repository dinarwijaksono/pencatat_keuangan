<div class="box">

    <div class="box-header">
        <h3 class="box-title"><?= date('D, d F Y', $date) ?></h3>
    </div><!-- /.box-header -->

    <div class="box-body table-responsive ">

        <a href="/" class="btn btn-link">Kembali</a>

        @if (session()->has('deleteSuccess'))
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= session('deleteSuccess') ?>
        </div>
        @endif

        <table class="table">
            @foreach ($listItem as $item)
            <tr>
                <td style="width: 30%;"><?= $item['title'] ?></td>
                @if ($item['type'] == 'income')
                <td style="width: 25%;" class="text-right text-primary"><?= 'Rp ' . number_format($item['value']) ?></td>
                <td style="width: 25%;" class="text-right text-danger"></td>
                @else
                <td style="width: 25%;" class="text-right text-primary"></td>
                <td style="width: 25%;" class="text-right text-danger"><?= 'Rp ' . number_format($item['value']) ?></td>
                @endif
                <td style="width: 10%;">
                    <a class="btn btn-xs btn-success btn-block">Edit</a>
                </td>
                <td style="width: 10%;">
                    <?php $id = $item['id'] ?>
                    <button type="button" wire:click="deleteItem('{{$item['id']}}')" class="btn btn-xs btn-danger btn-block">Hapus</button>
                </td>
            </tr>
            @endforeach

            <tr class="bg-info">
                <td style="width: 30%;"><b>Total </b></td>
                <td style="width: 30%;" class="text-right text-primary"><b><?= 'Rp ' . number_format($todayIncome) ?></b></td>
                <td style="width: 30%;" class="text-right text-danger"><b><?= 'Rp ' . number_format($todaySpending) ?></b></td>
                <td style="width: 10%;"></td>
                <td style="width: 10%;"></td>
            </tr>

        </table>

    </div><!-- /.box-body -->

    <div class="box-footer clearfix text-center" style="margin-top: 30px;">
        <div class="row ">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                <a href="/Transaction/addItem" class="btn btn-block btn-sm btn-primary">Tambah</a>
            </div>
        </div>
    </div>

</div><!-- /.box -->