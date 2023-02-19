<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application</title>

    <link rel="stylesheet" href="/Asset/fonts/fonts.css">

    <link rel="stylesheet" href="/css/mycss.css">

    <script src="/Asset/tailwind326/js/tailwind.js"></script>
</head>

<body class="bg-slate-200">

    <main class="container mt-14 ">
        <div class="flex justify-center">
            <div class="w-96">
                <h1 class="text-[32px] mb-4 text-center"><span style="font-family: 'Lato-black';">Pencatat</span>
                    Keuangan
                </h1>

                <!-- box -->
                <section class="bg-white p-4 drop-shadow-2xl">
                    @yield('content')
                </section>
                <!-- end box -->

            </div>
        </div>
    </main>

</body>

</html>