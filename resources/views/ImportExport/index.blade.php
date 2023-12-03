@extends('layouts.main')

@section('main-section')
<section class="content-header">
    <h1>Import / Export</h1>

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
    <div class="row">
        <div class="col-xs-12">

            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Import file</h3>
                </div><!-- /.box-header -->

                <form action="/Import-export-data/doImport" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="box-body">

                        <div class="form-group">
                            <label for="file">File input</label>
                            <input type="file" name="file" id="file">
                            @error('file')
                            <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>

                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-sm btn-block btn-primary">Import file</button>
                            </div>
                </form>

                <form action="/Import-export-data/downloadFormat" method="post">
                    @csrf

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-sm btn-warning btn-block">Download format</button>
                    </div>
                </form>

            </div>
        </div>

    </div>

    </div>

    </div>
</section>

@endsection