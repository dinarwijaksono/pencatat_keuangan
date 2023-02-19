<div>
    <table class="table table-bordered">
        <tr>
            <th style="width: 10px"></th>
            <th>Nama</th>
            <th style="width: 40px; text-align: center;">Type</th>
            <th style="text-align: center;">Action</th>
        </tr>

        <?php $i = 1; ?>
        @foreach ($listCategory as $category)
        <tr>
            <td><?= $i++ . '.' ?></td>
            <td><?= $category['name'] ?></td>
            @if ($category['type'] == 'income')
            <td class="text-center"><span class="badge bg-green"><?= $category['type'] ?></span></td>
            @else
            <td class="text-center"><span class="badge bg-red"><?= $category['type'] ?></span></td>
            @endif
            <td>
                <div class="row">
                    <div class="col-md-6">
                        <form action="/Category/delete" method="post">
                            @csrf
                            @method('delete')

                            <input type="hidden" name="id" value="<?= $category['id'] ?>">
                            <button type="submit" class="btn btn-block btn-danger btn-xs">Hapus</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form>
                            <a href="/Category/edit/<?= $category['id'] ?>" class="btn btn-block btn-success btn-xs">Edit</a>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
</div>