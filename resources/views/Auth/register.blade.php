@extends('layouts/auth')

@section('content')
<div>
    <h2 class="text-[24px] mb-3 text-center" style="font-family: 'Lato-black'">Register</h2>

    <!-- alert -->
    @if ( session('registerSuccess'))
    <div class="p-2 bg-red-500 mb-3 rounded text-[14px]">
        <p class="p-0 text-white"><?= session('registerSuccess') ?></p>
    </div>
    @endif

    <form class="mb-4">
        @csrf

        <div class="mb-3">
            <input type="text" name="username" class="border border-gray-300 p-1 w-full" placeholder="Username">
            @error('username')
            <p class="text-[14px] text-red-500"><?= $message ?></p>
            @enderror
        </div>

        <div class="mb-3">
            <input type="email" name="email" class="border border-gray-300 p-1 w-full" placeholder="Email">
            @error('email')
            <p class="text-[14px] text-red-500"><?= $message ?></p>
            @enderror
        </div>

        <div class="mb-3">
            <input type="password" name="password" class="border border-gray-300 p-1 w-full" placeholder="Password">
            @error('email')
            <p class="text-[14px] text-red-500"><?= $message ?></p>
            @enderror
        </div>

        <div class="mb-3">
            <input type="password" name="password_confirmation" class="border border-gray-300 p-1 w-full" placeholder="Konfimasi password">
            @error('password_confirmation')
            <p class="text-[14px] text-red-500"><?= $message ?></p>
            @enderror
        </div>

        <div class="flex justify-end ">
            <button class="bg-sky-500 text-white w-20 py-1 px-3 ">Daftar</button>
        </div>
    </form>

    <a href="/Auth/login" class="text-sky-400 hover:underline hover:underline-offset-4 block text-center">Saya
        sudah punya akun.</a>
</div>
@endsection