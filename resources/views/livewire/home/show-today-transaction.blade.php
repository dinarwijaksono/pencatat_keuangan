<table class="table-auto border-collapse w-full text-[14px]">
    <tbody>

        @foreach ($todayTransaction as $transaction)
        <tr class="border border-t-0  border-x-0 border-slate-200">
            @if ($transaction['category_name'] == null)
            <td class="w-4/12 p-1 "><span class="text-red-500">Tidak berkategori</span> - <?= $transaction['title'] ?></td>
            @else
            <td class="w-4/12 p-1 "><?= $transaction['category_name'] ?> - <?= $transaction['title'] ?></td>
            @endif
            @if ($transaction['type'] == 'income')
            <td class="w-3/12 p-1 text-sky-800 text-right"><?= 'Rp. ' . number_format($transaction['value']) ?></td>
            <td class="w-3/12 p-1 text-red-500 text-right"></td>
            @else
            <td class="w-3/12 p-1 text-sky-800 text-right"></td>
            <td class="w-3/12 p-1 text-red-500 text-right"><?= 'Rp. ' . number_format($transaction['value']) ?></td>
            @endif
            <td class="w-1/12 p-1 ">
                <a href="/Transaction/edit/<?= $transaction['id'] ?>" class="block text-center bg-green-500 p-1 w-full rounded text-white text-[12px]">Edit</a>
            </td>
            <td class="w-1/12 p-1 ">
                <button wire:click="deleteItem('{{$transaction['id']}}')" class="bg-red-500 p-1 w-full rounded text-white text-[12px]">Hapus</button>
            </td>
        </tr>
        @endforeach

        <tr class="bg-sky-100">
            <td class="w-4/12 p-1 "><b>Total</b></td>
            <td class="w-3/12 p-1 text-sky-800 text-right"><?= 'Rp. ' . number_format($todayTotal['income']) ?></td>
            <td class="w-3/12 p-1 text-red-500 text-right"><?= 'Rp. ' . number_format($todayTotal['spending']) ?></td>
            <td class="w-1/12 p-1 "></td>
            <td class="w-1/12 p-1 "></td>
        </tr>

    </tbody>
</table>