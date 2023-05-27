<div class="mt-28 basis-5/12 bg-white shadow-md p-1">
    <h1 class="text-center"><b>LOGIN</b></h1>

    <?php if (session()->has('loginFailed')) : ?>
        <div class="alert bg-danger m-2">
            <p><?= session()->get('loginFailed') ?></p>
        </div>
    <?php endif ?>

    <div class="input-group ">
        <label for="username">username</label>
        <input type="text" wire:model="username" wire:keydown.enter="doLogin" id="username" placeholder="username" autocomplete="off">
        @error('username')
        <p class="text-danger"><?= $message ?></p>
        @enderror
    </div>

    <div class="input-group ">
        <label for="username">password</label>
        <input type="password" wire:model="password" wire:keydown.enter="doLogin" id="password" placeholder="password">
        @error('password')
        <p class="text-danger"><?= $message ?></p>
        @enderror
    </div>

    <div class="p-1 flex justify-end">
        <div class="basis-5/12">
            <button wire:click="doLogin" class="btn bg-primary">Login</button>
        </div>
    </div>

    <div class="my-6">
        <a href="/Auth/register" class="btn-link text-center">Saya belum punya akun.</a>
    </div>

</div>