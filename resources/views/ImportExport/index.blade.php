@extends('layouts.main')

@section('main-section')
<section class="box">
    <div class="mb-2">
        <h3>Export</h3>
    </div>

    <form action="/ImportExport/doExport" method="post">
        @csrf

        <div class="input-group">
            <label for="period">Pilih period</label>
            <select id="period" name="period">
                <?php foreach ($periodList as $p) : ?>
                    <option value="<?= $p['period'] ?>"><?= $p['period'] ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="flex justify-end input-group">
            <div class="basis-3/12">
                <button type="submit" class="btn-sm bg-success">Export</button>
            </div>
        </div>
    </form>

</section>

<section class="box">
    <div class="mb-2">
        <h3>Import</h3>
        <p class="text-[14px]">Document yang dapat di import adalah dokument yang berextensin ".xlsx", dan
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
        <form action="/ImportExport/doImport" method="post" enctype="multipart/form-data">
            @csrf

            <?php if (session()->has('importFailed')) : ?>
                <div class="alert bg-danger">
                    <p><?= session()->get('importFailed') ?></p>
                </div>
            <?php endif ?>

            <?php if (session()->has('listImportError')) : ?>
                <div>
                    <?php foreach (session()->get('listImportError') as $error) : ?>
                        <p class="text-danger">- <?= $error ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <div class="input-group">
                <label for="file">Pilih document</label>
                <input type="file" name="file" id="file">
                @error('file')
                <p class="text-danger"><?= $message ?></p>
                @enderror
            </div>

            <div class="flex justify-end input-group">
                <div class="basis-3/12">
                    <button type="submit" class="btn-sm bg-success">Import document</button>
                </div>
            </div>
        </form>

    </div>
</section>
@endsection