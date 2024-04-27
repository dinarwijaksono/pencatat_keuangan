<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Telegram id</h3>
    </div>

    <div class="box-body">
        <div class="form-controll">
            <label for="chatId">Chat id</label>
            <input type="text" wire:model="chatId" class="form-control" id="chatId" placeholder="chat id">
            @error('chatId')
                <p class="text-danger">{{ $message }}</p>
            @enderror

        </div>
    </div>

    <div class="box-footer row">
        <div class="col-sm-10"></div>
        <div class="col-sm-2">
            <button type="button" wire:click="doSetTelegramId" class="btn btn-block btn-sm btn-primary">Simpan</button>
        </div>
    </div>
</div>
