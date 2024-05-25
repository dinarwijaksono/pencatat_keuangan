<aside class="bg-slate-600">

    <div class="profile">
        <h3 class="text-white mb-0">{{ auth()->user()->username }}</h3>
    </div>

    <hr class="my-5 mx-3">

    <ul>
        <a href="/">
            <li>Dashboard</li>
        </a>

        <a href="/Category">
            <li>Kategori</li>
        </a>

        <a href="/Transaction-history">
            <li>Histori Transaksi</li>
        </a>

        <a href="/Import-export-data">
            <li>Impor / Export data</li>
        </a>

        <a href="/Report">
            <li>Laporan</li>
        </a>
    </ul>

</aside>
