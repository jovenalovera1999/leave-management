<nav class="navbar navbar-expand-lg bg-body-tertiary shadow sticky-top">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-black" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span class="text-success fs-6 me-2">LOGGED IN AS:</span> {{ (auth()->user()->middle_name) ? auth()->user()->last_name . ', ' . auth()->user()->first_name . ' ' . auth()->user()->middle_name[0] . '. ' . auth()->user()->suffix_name : auth()->user()->last_name . ', ' . auth()->user()->first_name . ' ' . auth()->user()->suffix_name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <form action="/process/logout" method="post">
                        @csrf
                        <li><button type="submit" class="dropdown-item">LOGOUT</button></li>
                    </form>
                </ul>
            </li>
        </ul>
    </div>
</nav>
