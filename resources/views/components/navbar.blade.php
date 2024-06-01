<nav>
    <div class="flex">
        <div class="basis-2/12">
            <p class="text-white block sm:hidden"><b>PENCATAT</b> Keuangan</p>
            <h3 class="text-white hidden sm:block"><b>PENCATAT</b> Keuangan</h3>
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
