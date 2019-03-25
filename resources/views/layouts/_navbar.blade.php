<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    @if (!Auth::guest())
        <button id="menu-toggle" class="navbar-toggler" type="button" style="margin-right: 15px; display: inline-block;">
            <span class="navbar-toggler-icon"></span>
        </button>
    @endif
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{\App\Setting::val('logotipo-horizontal', '/img/no-image.png')}}"/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            @if (Auth::guest())
                <li class="nav-item"><a class="nav-link bg-light" href="{{ url('/login') }}">Login</a></li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle bg-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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