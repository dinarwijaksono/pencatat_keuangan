@extends('layouts.main')

@section('main-section')
<section class="box">
    <div class="mb-2">
        <h3>Export</h3>
    </div>

    <div class="input-group">
        <label for="period">Pilih period</label>
        <select id="period">
            <option>Mar 2022</option>
            <option>Feb 2022</option>
            <option>Jan 2022</option>
        </select>
    </div>

    <div class="flex justify-end input-group">
        <div class="basis-3/12">
            <button class="btn-sm bg-success">Export</button>
        </div>
    </div>

</section>

<section class="box">
    <div class="mb-2">
        <h3>Import</h3>
        <p class="text-[14px]">Document yang dapat di import adalah dokument yang berextensin ".csv", dan
            berformat khusus</p>
    </div>

    <div class="mb-2 flex justify-end input-group">
        <div class="basis-4/12">
            <form action="/ImportExport/downloadFormat" method="post">
                @csrf

                <button type="submit" class="btn-sm bg-info">Download format dokument</button>
            </form>
        </div>
    </div>

    <hr class="my-3">

    <div class="mb-2">
        <div class="input-group">
            <label for="file">Pilih document</label>
            <input type="file" name="file" id="file">
        </div>

        <div class="flex justify-end input-group">
            <div class="basis-3/12">
                <button class="btn-sm bg-success">Import document</button>
            </div>
        </div>

    </div>
</section>
@endsection