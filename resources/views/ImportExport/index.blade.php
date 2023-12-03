@extends('layouts.main')

@section('main-section')
<section class="content-header">
    <h1>Import / Export</h1>

</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Import file</h3>
                </div><!-- /.box-header -->

                <form role="form">
                    <div class="box-body">

                        <div class="form-group">
                            <label for="file">File input</label>
                            <input type="file" id="file">
                            <!-- <p class="help-block">Example block-level help text here.</p> -->
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