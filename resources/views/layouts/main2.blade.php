<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatat keuangan</title>

    <link rel="stylesheet" href="/Asset/fonts/fonts.css">
    <link rel="stylesheet" href="/Asset/fontawesome-free-6.3.0/css/all.min.css">

    <link rel="stylesheet" href="css/mycss.css">

    @livewireStyles

    <script src="/Asset/tailwind326/js/tailwind.js"></script>
</head>

<body class="bg-slate-200">

    <!-- navbar -->
    <nav class="flex px-2 py-1 bg-sky-600">

        <div class="basis-1/4 ">
            <h1 class="sm:text-[12px] lg:text-[24px] inline-block align-middle text-white">
                <span style="font-family: 'Lato-black';">Pencatat</span>keuangan
            </h1>
        </div>

        <div class="basis-3/4 flex justify-end">
            <ul class="text-slate-300 mt-2 align-bottom ">
                <li>
                    <form action="/Auth/logout" method="post">
                        @csrf
                        <button class="inline-block rounded mr-2 py-0 px-1 hover:underline hover:text-white hover:underline-offset-4">
                            Logout</button>
                    </form>
                </li>
                </a>
            </ul>
        </div>
    </nav>
    <!-- end navbar -->

    <main class="md:flex">
        <!-- sidebar -->
        <aside class="md:basis-3/12 bg-zinc-700 " style="min-height: 700px;">

            <div class=" mb-3 border-l-4 border-zinc-400 bg-zinc-400 text-slate-200 p-2">
                <p><i class="fa-solid fa-user"></i> <?= auth()->user()->username ?></p>
            </div>

            <ul>
                <a href="/">
                    <li class="bg-zinc-600 border-l-4 border-zinc-600 hover:border-sky-500 hover:bg-zinc-500 text-slate-200 p-2">
                        <i class="fa-solid fa-chart-line"></i> Dashboard
                    </li>
                </a>

                <a href="">
                    <li class="bg-zinc-600 border-l-4 border-zinc-600 hover:border-sky-500 hover:bg-zinc-500 text-slate-200 p-2">
                        <i class="fa-solid fa-chart-line"></i> Report
                    </li>
                </a>

                <a href="/Setting">
                    <li class="bg-zinc-600 border-l-4 border-zinc-600 hover:border-sky-500 hover:bg-zinc-500 text-slate-200 p-2">
                        <i class="fa-solid fa-chart-line"></i> Setting
                    </li>
                </a>

            </ul>
        </aside>


        <article class="md:basis-9/12 p-3">
            @yield('content')
        </article>
        <!-- end sidebar -->

    </main>

    <section class="flex">
        <div class="basis-3/12 bg-zinc-700 "></div>

        <!-- footer -->
        <footer class="basis-9/12 bg-white py-1">
            <p class="text-center">Build with - <span class="text-sky-500"><a href="https://www.instagram.com/dinarwijaksono11/" target="_blank">@dinarwijaksono11</a></span></p>
            <p class="text-center">App Version 0.0.0</p>
        </footer>
        <!-- end footer -->
    </section>

    @livewireScripts
</body>

</html>