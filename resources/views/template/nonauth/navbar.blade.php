<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">News App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Author</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                Tags
            </a>
            <div class="dropdown-menu scrollable-dropdown">
                <a class="dropdown-item" href="#">Politics</a>
                <a class="dropdown-item" href="#">Finance</a>
                <a class="dropdown-item" href="#">Technology</a>
                <a class="dropdown-item" href="#">Health</a>
                <a class="dropdown-item" href="#">Sports</a>
                <a class="dropdown-item" href="#">Entertainment</a>
                <a class="dropdown-item" href="#">Science</a>
                <a class="dropdown-item" href="#">Education</a>
                <a class="dropdown-item" href="#">Culture</a>
                <a class="dropdown-item" href="#">Environment</a>
                <a class="dropdown-item" href="#">Travel</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Investing</a>
            </div>
            </li>
            @auth
                @if (Auth::user()->role == 1)
                <li class="nav-item">
                    <a class="nav-link" href="/posts">My Dashboard</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="/users">Admin Dashboard</a>
                </li>
                @endif
            @endauth
        </ul>
        @auth
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="btn btn-outline-light">
                Log
                Out <span data-feather="log-out"></span></button>
        </form>
        @else
        <a class="btn btn-outline-light " href="/login">Log In</a>
        @endauth
    </div>
</nav>
