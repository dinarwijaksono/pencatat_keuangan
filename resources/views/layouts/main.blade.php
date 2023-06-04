<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PencatatKeuangan</title>
    <link rel="stylesheet" href="/Asset/tailwind/style.css">

    @livewireStyles
</head>

<body>

    <nav class="main">
        <div class="flex">

            <section class="basis-3/12">
                <h2 class="text-white">Pencatat<b>Keuangan</b></h2>
            </section>

            <section class="basis-9/12 menu">
                <ul>
                    <li>
                        <b><a href="/Auth/logout">Logout</a></b>
                    </li>
                </ul>
            </section>

        </div>
    </nav>

    <div class="flex">

        <aside class="basis-3/12 main">
            <div class="header">
                <h4><b><u><?= session()->get('username') ?></u></b></h4>
            </div>

            <ul>
                <a href="/">
                    <li>Dashboard</li>
                </a>

                <a href="/Category">
                    <li>Kategori</li>
                </a>

                <a href="/ImportExport">
                    <li>Import Export</li>
                </a>

                <a href="/Report">
                    <li>Laporan</li>
                </a>
            </ul>
        </aside>

        <main class="p-3 basis-9/12">

            @yield('main-section')

        </main>
    </div>

    <footer class="main">
        <p>Build by - <a href="https://www.instagram.com/dinarwijaksono11" target="__blank">@dinarwijaksono11</a>
        </p>
    </footer>

    @livewireScripts
</body>

</html>