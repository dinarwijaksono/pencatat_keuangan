@extends('layouts.main')

@section('main-section')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Kategori</h1>

</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">List kategori</h3>
                    <div class="box-tools">
                        <!-- <div class="input-group">
                            <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" />
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div> -->
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Type</th>
                            <th>Dibuat</th>
                            <th>Diedit</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td><span class="label label-success">Approved</span></td>
                            <td>11-7-2014</td>
                            <td>11-7-2014</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td><span class="label label-success">Approved</span></td>
                            <td>11-7-2014</td>
                            <td>11-7-2014</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td><span class="label label-success">Approved</span></td>
                            <td>11-7-2014</td>
                            <td>11-7-2014</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td><span class="label label-success">Approved</span></td>
                            <td>11-7-2014</td>
                            <td>11-7-2014</td>
                        </tr>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>


    <div class="row">


        @livewire('Category.create-category')
    </div>


</section>

@endsection