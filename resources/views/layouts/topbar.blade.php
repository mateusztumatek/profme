

    <nav class="topbar navbar navbar-expand-lg ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li cass="nav-item active">
                    <a class="nav-link" href="#">Znajomi </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Strona główna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Statysyki</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0 ml-3">
                <input class=" form-control mr-sm-2 search-form" type="search" placeholder="Wyszukaj" aria-label="Search">
                <button style="padding:5px !important; border-color: rgba(255,255,255,0.3)!important; background-color: transparent !important;" class="hvr-sweep-to-right my-2 my-sm-0 my-button" type="submit"><i class=" fa fa-search"></i> Search</button>
            </form>
            <form method="POST" action="{{route('logout')}}">
            @CSRF
                <a style="color: white" onclick="this.parentNode.submit()" class="ml-3"><i style="font-size: 20px;" class="fa fa-power-off"></i> Wyloguj</a>
            </form>

        </div>
    </nav>
    <div class="site-position">
            @php



            @endphp
            <div class=" left-position">
                <div class="left-position-content">

                    <a href="{{route('home')}}">Home</a>


                </div>

            </div>

        <div class="  right-position">

        </div>



        </div>



