<section class="sm:basis-full md:basis-4/12 mt-24">
    <h1 class="text-center"><b>PENCATAT</b> Keuangan</h1>

    <section class="bg-white p-4 shadow-md shadow-slate-300 mb-4">

        @if (session()->has('failed'))
            <div class="border border-red-500 p-2 mb-2 bg-red-100 text-danger">
                <p>{{ session()->get('failed') }}</p>
            </div>
        @endif

        <div class="mb-4">
            <label for="email">Email</label>
            <input type="text" id="email" wire:model="email" wire:keyup.enter="doLogin"
                class="block border border-slate-300 w-full px-2 py-1 outline-none focus:border-blue-500"
                placeholder="email">
            @error('email')
                <p class="text-red-500 italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password">Password</label>
            <input type="password" id="password" wire:model="password" wire:keyup.enter="doLogin"
                class="block border border-slate-300 w-full px-2 py-1 outline-none focus:border-blue-500"
                placeholder="Password">
            @error('password')
                <p class="text-red-500 italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <div class="basis-4/12">
                <button type="button" wire:click="doLogin"
                    class="px-2 py-1 bg-blue-500 hover:bg-blue-400 active:bg-blue-300 text-white w-full">Login</button>
            </div>
        </div>

    </section>

    <a href="/Auth/register" class="block text-center hover:underline hover:text-blue-400">Belum punya akun.</a>

</section>
