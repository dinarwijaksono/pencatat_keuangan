<section class="sm:basis-full md:basis-4/12 mt-24">
    <h1 class="text-center"><b>PENCATAT</b> Keuangan</h1>

    <section class="bg-white p-4 shadow-md shadow-slate-300 mb-4">

        <p class="text-center mb-2">Daftar untuk memulai</p>

        @if (session()->has('success'))
            <div class="border border-green-500 p-2 mb-2 bg-green-100 text-success">
                <p>{{ session()->get('success') }}</p>
            </div>
        @endif

        <div class="mb-4">
            <label for="email">Email</label>
            <input type="text" id="email" wire:model="email"
                class="block border border-slate-300 w-full px-2 py-1 outline-none focus:border-blue-500"
                placeholder="email">
            @error('email')
                <p class="text-red-500 italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="username">Username</label>
            <input type="text" id="username" wire:model="username"
                class="block border border-slate-300 w-full px-2 py-1 outline-none focus:border-blue-500"
                placeholder="username">
            @error('username')
                <p class="text-red-500 italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password">Password</label>
            <input type="password" id="password" wire:model="password"
                class="block border border-slate-300 w-full px-2 py-1 outline-none focus:border-blue-500"
                placeholder="Password">
            @error('password')
                <p class="text-red-500 italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password">Password</label>
            <input type="password" id="password" wire:model="confirmPassword"
                class="block border border-slate-300 w-full px-2 py-1 outline-none focus:border-blue-500"
                placeholder="Password">
            @error('confirmPassword')
                <p class="text-red-500 italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <div class="basis-4/12">
                <button type="button" wire:click="doRegister"
                    class="px-2 py-1 bg-blue-500 hover:bg-blue-400 active:bg-blue-300 text-white w-full">Buat
                    akun</button>
            </div>
        </div>

    </section>

    <a href="/Auth/login" class="block text-center hover:underline hover:text-blue-400">Sudah punya akun.</a>

</section>
