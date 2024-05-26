@extends('layouts.main')

@section('main-section')
    <section class="content-header">
        <h2>Import / Export</h2>

        @if (session()->has('importFailed'))
            <div style="margin-top: 20px;" class="box box-danger">
                <div class="box-body">
                    <p> {{ session()->get('importFailed') }} </p>
                </div>
            </div>
        @endif

        @if (session()->has('listImportError'))
            <div style="margin-top: 20px;" class="box box-danger">
                <div class="box-body">
                    <ul>
                        @foreach (session()->get('listImportError') as $error)
                            <li>{{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

    </section>

    <section class="content">
        <section class="box p-4 border-l-4 border-green-700">
            <div class="box-header">
                <h3 class="box-title">Import file</h3>
            </div><!-- /.box-header -->

            <form action="/Import-export-data/doImport" method="post" enctype="multipart/form-data">
                @csrf

                <div class="box-body">

                    <div class="form-group">
                        <label for="file">File input</label>
                        <input type="file" name="file" id="file"
                            class="block border border-slate-300 w-full py-1 px-2 mb-4">
                        @error('file')
                            <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </div>

                </div><!-- /.box-body -->

                <div class="box-footer flex justify-end gap-2">

                    <div class="basis-2/12">
                        <button type="submit" class="bg-primary text-white py-1 px-2 w-full">Import file</button>
                    </div>

            </form>

            <form action="/Import-export-data/downloadFormat" method="post">
                @csrf

                <div class="basis-2/12">
                    <button type="submit" class="bg-success text-white py-1 px-2 w-full">Download format</button>
                </div>

                </div> {{-- end box-footer --}}
            </form>
        </section>

        @livewire('import-export.box-export')

    </section>

@endsection
