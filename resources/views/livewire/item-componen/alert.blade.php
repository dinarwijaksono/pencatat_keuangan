<div @class([
    'alert-success' => $status == 'success',
    'alert-danger' => $status == 'failed',
]) @style(['display: none;' => $isHiden])>
    <p>{{ $message }}</p>

    <div>
        <button type="button" wire:click="doHiden">Tutup</button>
    </div>
</div>
