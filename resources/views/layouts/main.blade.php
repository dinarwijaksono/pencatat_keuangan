<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>

    {{-- google font hind --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Guntur:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- css tailwind --}}
    <link rel="stylesheet" href="/tailwind/style.css">

    @livewireStyles
</head>

<body>

    <x-navbar />

    <section class="container md:flex">

        <div class="basis-full md:basis-2/12 block">
            @livewire('components.sidebar')
        </div>

        <main class="basis-full md:basis-10/12 p-2">
            @yield('main-section')
        </main>

    </section>

    @livewireScripts

</body>

</html>
