@extends('layouts/auth')

@section('content')
<div>
    <h2 class="text-[24px] mb-3 text-center" style="font-family: 'Lato-black'">Login</h2>

    <!-- alert -->
    @if (session()->has('loginFailed'))
    <div class="p-2 bg-red-500 mb-3 rounded text-[14px]">
        <p class="p-0 text-white"><?= session('loginFailed') ?></p>
    </div>
    @endif

    <form class="mb-4" action="/Auth/login" method="post">
        @csrf

        <div class="mb-3">
            <input type="text" name="username" class="border border-gray-300 p-1 w-full" placeholder="Username" autocomplete="off">
            @error('username')
            <p class="text-[14px] text-red-500"><?= $message ?></p>
            @enderror
        </div>

        <div class="mb-3">
            <input type="password" name="password" class="border border-gray-300 p-1 w-full" placeholder="Password">
            @error('password')
            <p class="text-[14px] text-red-500"><?= $message ?></p>
            @enderror
        </div>

        <div class="flex justify-end ">
            <button type="submit" class="bg-sky-500 text-white w-20 py-1 px-3 ">Login</button>
        </div>
    </form>

    <a href="/Auth/register" class="text-sky-400 hover:underline hover:underline-offset-4 block text-center">Saya
        belum punya akun.</a>
</div>
@endsection