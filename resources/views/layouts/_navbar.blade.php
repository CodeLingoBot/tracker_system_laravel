<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="{{ url('/') }}" style="flex: 1;">
        {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="flex: 0;">
        <ul class="navbar-nav mr-auto">
            @if (Auth::guest())
                <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Registrar</a></li>
            @else
                @if (Auth::user()->isAdmin())
                    <li class="nav-item"><a class="nav-link" href="{{ url('/users') }}">Usuários</a></li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="right: 0; left: auto;">
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <a class="dropdown-item" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();" href="{{ url('/logout') }}">Logout</a>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>