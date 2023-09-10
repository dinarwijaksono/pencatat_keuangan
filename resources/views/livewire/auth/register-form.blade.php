<div class="mt-28 basis-5/12 bg-white shadow-md p-1">
    <h1 class="text-center"><b>REGISTER</b></h1>

    <?php if (session()->has('registerSuccess')) : ?>
        <div class="alert bg-success m-2">
            <p><?= session()->get('registerSuccess') ?></p>
        </div>
    <?php endif ?>

    <div class="input-group ">
        <label for="username">username</label>
        <input type="text" wire:model.live="username" id="username" placeholder="username" autocomplete="off">
        @error('username')
        <p class="text-danger"><?= $message ?></p>
        @enderror
    </div>

    <div class="input-group ">
        <label for="password">password</label>
        <input type="password" wire:model.live="password" id="password" placeholder="password">
        @error('password')
        <p class="text-danger"><?= $message ?></p>
        @enderror
    </div>

    <div class="input-group ">
        <label for="confirm_password">konfirmasi password</label>
        <input type="password" wire:model.live="confirm_password" id="confirm_password" placeholder="konfirmasi password">
        @error('confirm_password')
        <p class="text-danger"><?= $message ?></p>
        @enderror
    </div>

    <div class="p-1 flex justify-end">
        <div class="basis-5/12">
            <button wire:click="doRegister" class="btn bg-primary">Register</button>
        </div>
    </div>

    <div class="my-6">
        <a href="/Auth/login" class="btn-link text-center">Saya sudah punya akun.</a>
    </div>

</div>