<nav>
    <div class="flex">
        <div class="basis-2/12">
            <h3 class="text-white"><b>PENCATAT</b> Keuangan</h3>
        </div>

        <div class="basis-10/12">
            <ul>
                <li class="btn">
                    <form action="/Auth/logout" method="post">
                        @csrf

                        <button type="submit" class="bg-danger">Logout</button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</nav>
