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

    <main>

        <section class="flex flex-row justify-center">
            @livewire('auth.login-form')
        </section>

    </main>

    @livewireScripts
</body>

</html>