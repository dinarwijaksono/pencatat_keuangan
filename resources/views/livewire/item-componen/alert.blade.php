<div @class([
    'alert',
    'alert-success' => $status == 'success',
    'alert-danger' => $status == 'failed',
]) @style(['display: none;' => $isHiden])>
    <div class="row">
        <div class="col-sm-11">
            <p>{{ $message }}</p>
        </div>
        <div class="col-sm-1">
            <button type="button" wire:click="doHiden" class="btn btn-sm btn-default btn-block">Tutup</button>
        </div>
    </div>
</div>
