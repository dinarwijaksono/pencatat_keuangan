<div class="login-box-body">

    @if (session()->has('failed'))
        <div class="box box-solid bg-red">
            <div class="box-body">
                <p> {{ session()->get('failed') }} </p>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    @endif

    <form>
        <div class="form-group has-feedback">
            <input type="text" class="form-control " wire:model="email" wire:keydown.enter="doLogin"
                placeholder="Email" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @error('email')
                <p class="text-danger"> {{ $message }} </p>
            @enderror
        </div>

        <div class="form-group has-feedback">
            <input type="password" wire:model="password" wire:keydown.enter="doLogin" class="form-control"
                placeholder="Password" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @error('password')
                <p class="text-danger"> {{ $message }} </p>
            @enderror
        </div>

        <div class="row">
            <div class="col-xs-8">
            </div><!-- /.col -->
            <div class="col-xs-4">
                <button type="button" wire:click="doLogin" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
        </div>
    </form>

    <a href="/Auth/register" class="text-center">Saya belum mempunyai akun.</a>

</div><!-- /.login-box-body -->
