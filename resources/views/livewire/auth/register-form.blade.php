<div class="register-box-body">
    <p class="login-box-msg">Daftar akun untuk memulai semuanya.</p>

    @if (session()->has('success'))
    <div class="box box-solid bg-green">
        <div class="box-header">
            <h3 class="box-title">Success</h3>
        </div>
        <div class="box-body">
            <p> {{ session()->get('success') }} </p>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    @endif

    <div class="form-group has-feedback">
        <input type="text" wire:model="email" class="form-control" placeholder="Email" />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @error('email')
        <p class="text-danger"> {{ $message }} </p>
        @enderror
    </div>

    <div class="form-group has-feedback">
        <input type="text" wire:model="username" class="form-control" placeholder="Username" />
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @error('username')
        <p class="text-danger"> {{ $message }} </p>
        @enderror
    </div>

    <div class="form-group has-feedback">
        <input type="password" wire:model="password" class="form-control" placeholder="Password" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @error('password')
        <p class="text-danger"> {{ $message }} </p>
        @enderror
    </div>

    <div class="form-group has-feedback">
        <input type="password" wire:model="confirm_password" class="form-control" placeholder="Retype password" />
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        @error('confirm_password')
        <p class="text-danger"> {{ $message }} </p>
        @enderror
    </div>

    <div class="row">
        <div class="col-xs-8">
        </div><!-- /.col -->
        <div class="col-xs-4">
            <button type="submit" wire:click="doRegister" class="btn btn-primary btn-block btn-flat">Register</button>
        </div><!-- /.col -->
    </div>


    <a href="/Auth/login" class="text-center">Saya sudah mempunai akun.</a>
</div><!-- /.form-box -->