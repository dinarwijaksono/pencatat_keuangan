<section class="box p-4 border-l-4 border-green-700">
    <div class="box-header">
        <h3 class="box-title">Export file</h3>
    </div><!-- /.box-header -->

    <div class="box-body">

        <div class="mb-4">
            <label for="period">Periode</label>
            <select id="period"
                class="outline-none focus:border-green-700 px-2 border border-slate-300 block w-full text-[16px]">
                <option>-- Pilih Periode --</option>
                <option value="all">Semua periode</option>
                @foreach ($listPeriod as $period)
                    <option value="{{ $period }}">{{ $period }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end">
            <div class="basis-2/12">
                <button type="button" wire:click="doExport"
                    class="bg-primary py-1 px-2 text-white w-full">Export</button>
            </div>
        </div>

    </div>
</section>
