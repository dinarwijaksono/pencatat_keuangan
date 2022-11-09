@extends('layouts/main')

@section('content-wrapper')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
        <li><a href="/Setting">Setting</a></li>
        <li class="active">Category</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="example-modal" id="box-modal-add-category" style="display: none;">
        <div class="modal" style="position: absolute; top: auto; bottom: auto; right: 0; left: 0; display: block; z-index: 1000; background: transparent!important;">
            <div class="modal-dialog" style="border: 1px solid black;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="button-close-modal" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Buat kategori</h4>
                    </div>

                    <form>
                        <div class="modal-body">
                            <div class="box-body">

                                <input type="hidden" name="code" value="{{ auth()->user()->code }}">

                                <p id="allert" style="display: none; font-style: italic; font-size: 20px;">Lorem, ipsum dolor.</p>

                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nama kategori</label>
                                    <input type="text" name="category_name" class="form-control" placeholder="Nama kategori" />
                                    <p id="allert-name" style="color: red; display: none;"></p>
                                </div>

                                <div class="form-group">
                                    <label>Type </label>
                                    <select name="type" class="form-control">
                                        <option value="pemasukan">Pemasukan</option>
                                        <option value="pengeluaran">pengeluaran</option>
                                        <p id="allert-name" style="color: red; display: none;"></p>
                                    </select>
                                </div>

                            </div><!-- /.box-body -->

                        </div>

                        <div class="modal-footer">
                            <button type="button" id="button-simpan-category" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div><!-- /.example-modal -->


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Daftar kategori</h3>
        </div><!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 10%">No</th>
                        <th style="width: 35%">Nama</th>
                        <th class="text-center" style="width: 35%">Type</th>
                        <th style="width: 20%"></th>
                    </tr>
                </thead>

                <tbody>
                    <!-- <tr>
                        <td class="text-center">1.</td>
                        <td>Karton</td>
                        <td class="text-center"><span class="label label-success">pemasukan</span></td>
                        <td class="text-center">
                            <button class="btn btn-xs btn-danger btn-block">Hapus</button>
                        </td>
                    </tr> -->
                </tbody>


            </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
            <div class="row" style="margin-top: 20px;">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <button class="btn btn-sm btn-block btn-primary" id="bottom-add-category">Buat kategori</button>
                </div>
            </div>
        </div>
    </div><!-- /.box -->

</section><!-- /.content -->
<input type="hidden" id="code" name="code" value="<?= auth()->user()->code ?>" />

@push('scripts')
<script>
    /* Javascript untuk megelola modal */
    let boxModalAddCategory = document.getElementById('box-modal-add-category');
    let bottomCloshModal = document.getElementById('button-close-modal');
    let bottomAddCategory = document.getElementById('bottom-add-category');

    bottomAddCategory.addEventListener('click', function() {
        boxModalAddCategory.style.display = 'block';
    });

    bottomCloshModal.addEventListener('click', function() {
        boxModalAddCategory.style.display = 'none';
    });




    /* javascript mengelola tabel kategori */
    function setTableBody() {

        let tbody = document.getElementsByTagName('tbody')[0];
        let code = document.getElementById('code').value;

        tbody.innerHTML = '';

        let ajax_listCategory = new XMLHttpRequest();
        ajax_listCategory.open('GET', "/api/Category/listCategory/" + code);
        ajax_listCategory.onload = function() {
            let result = JSON.parse(ajax_listCategory.responseText);

            let listCategory = result['data']['listCategory'];
            for (let index = 0; index < listCategory.length; index++) {

                // tr
                let tr = document.createElement('tr');

                // td no
                let tdNo = document.createElement('td')
                tdNo.classList.add('text-center');
                tdNo.textContent = (index + 1) + '.';
                tr.appendChild(tdNo);

                // td name
                let tdName = document.createElement('td');
                tdName.textContent = listCategory[index].name;
                tr.appendChild(tdName);

                // td type
                let tdType = document.createElement('td');
                tdType.classList.add('text-center');
                let span = document.createElement('span');
                span.classList.add('label');
                if (listCategory[index].type == "pemasukan") {
                    span.classList.add('label-success')
                } else {
                    span.classList.add('label-danger')
                }
                span.textContent = listCategory[index].type;
                tdType.appendChild(span);
                tr.appendChild(tdType)

                // td action
                let tdAction = document.createElement('td');
                let button_delete = document.createElement('button');
                button_delete.textContent = 'Hapus';
                button_delete.setAttribute('type', 'button');
                button_delete.classList.add('btn');
                button_delete.classList.add('btn-xs');
                button_delete.classList.add('btn-block');
                button_delete.classList.add('btn-danger');
                tdAction.appendChild(button_delete);
                tr.appendChild(tdAction);

                button_delete.addEventListener('click', function() {
                    deleteCategory(code, listCategory[index].id)
                });

                tbody.appendChild(tr);
            }
        }
        ajax_listCategory.setRequestHeader('Content-Type', 'application/json');
        ajax_listCategory.send();
    } /* end setTableBody */
    setTableBody();



    /* delete category */
    function deleteCategory(code, category_id) {
        let ajax = new XMLHttpRequest();
        ajax.open('POST', "/api/Category/deleteCategory");
        ajax.setRequestHeader('Content-Type', 'application/json');
        ajax.send(JSON.stringify({
            code: code,
            category_id: category_id
        }));

        setTableBody();

    }



    /* javascript untuk fitur tambah category lewat api */
    let inputType = document.getElementsByName('type')[0];
    let inputNameCategory = document.getElementsByName('category_name')[0];
    let inputCode = document.getElementsByName('code')[0];
    let buttonSimpanCategory = document.getElementById('button-simpan-category');

    buttonSimpanCategory.addEventListener('click', function() {
        let ajax = new XMLHttpRequest();
        ajax.open('POST', "/api/Category/createCategory");
        ajax.onload = function() {

            let allert = document.getElementById('allert');
            let allert_name = document.getElementById('allert-name');

            allert.style.display = 'none';
            allert_name.style.display = 'none';

            allert.style.display = 'block';
            inputNameCategory.value = ''
            let res = JSON.parse(ajax.responseText);
            if (res.status == 'failed') {
                allert.style.color = 'red';
            } else {
                allert.style.color = 'green'
                setTableBody();
            }
            allert.innerHTML = res.message

            if (res.data.name.isError == true) {
                allert_name.style.display = 'block';
                allert_name.innerHTML = res.data.name.message;
            }

        }
        ajax.setRequestHeader('Content-Type', 'application/json');
        ajax.send(JSON.stringify({
            name: inputNameCategory.value,
            type: inputType.value,
            code: inputCode.value
        }))
    });
</script>
@endpush
@endsection