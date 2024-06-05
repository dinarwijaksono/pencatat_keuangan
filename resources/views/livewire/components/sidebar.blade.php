<aside class="bg-slate-600">

    <div class="profile">
        <h3 class="text-white mb-0 hidden md:block">{{ auth()->user()->username }}</h3>

        <button type="button" wire:click="doTogle" class="btn-primary md:hidden block w-full">Menu</button>

    </div>

    <hr class="my-5 mx-3 hidden md:block">

    <ul @class(['hidden' => $isHidden])>
        <a href="/">
            <li @class(['active' => session()->get('active_menu') == 'home'])>Dashboard</li>
        </a>

        <a href="/Category">
            <li @class(['active' => session()->get('active_menu') == 'category'])>Kategori</li>
        </a>

        <a href="/Import-export-data">
            <li @class(['active' => session()->get('active_menu') == 'impor-export'])>Impor / Export data</li>
        </a>

        <a href="/Report">
            <li @class(['active' => session()->get('active_menu') == 'report'])>Laporan</li>
        </a>
    </ul>

    <ul class="hidden md:block">
        <a href="/">
            <li @class(['active' => session()->get('active_menu') == 'home'])>Dashboard</li>
        </a>

        <a href="/Category">
            <li @class(['active' => session()->get('active_menu') == 'category'])>Kategori</li>
        </a>

        <a href="/Import-export-data">
            <li @class(['active' => session()->get('active_menu') == 'impor-export'])>Impor / Export data</li>
        </a>

        <a href="/Report">
            <li @class(['active' => session()->get('active_menu') == 'report'])>Laporan</li>
        </a>
    </ul>

</aside>
