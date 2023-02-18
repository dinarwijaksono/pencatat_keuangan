<table class="table">

    @foreach ($todayTransaction as $transaction )
    <tr>
        @if (is_null($transaction['category_name']))
        <td style="width: 30%;"><span class="text-danger">Tidak berkategori</span><?= " - " . $transaction['title'] ?></td>
        @else
        <td style="width: 30%;"><?= $transaction['category_name'] . " - " . $transaction['title'] ?></td>
        @endif
        @if ($transaction['type'] == 'income')
        <td style="width: 25%;" class="text-right text-primary"><?= 'Rp ' . number_format($transaction['value']) ?></td>
        <td style="width: 25%;" class="text-right text-danger"></td>
        @else
        <td style="width: 25%;" class="text-right text-primary"></td>
        <td style="width: 25%;" class="text-right text-danger"><?= 'Rp. ' . number_format($transaction['value']) ?></td>
        @endif

        <td style="width: 10%;">
            <a href="/Transaction/edit/<?= $transaction['id'] ?>" class="btn btn-xs btn-success btn-block">Edit</a>
        </td>
        <td style="width: 10%;">
            <button type="button" wire:click="deleteItem('{{$transaction['id']}}')" class="btn btn-xs btn-danger btn-block">Hapus</button>
        </td>
    </tr>
    @endforeach

    <tr class="bg-info">
        <td><b>Total </b></td>
        <td class="text-right text-primary"><b><?= 'Rp ' . number_format($todayTotal['income']) ?></b></td>
        <td class="text-right text-danger"><b><?= 'Rp ' . number_format($todayTotal['spending']) ?></b></td>
        <td></td>
        <td></td>
    </tr>

</table>