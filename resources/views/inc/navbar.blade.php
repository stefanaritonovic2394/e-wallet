<nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'E-WALLET') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/">Početna <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">O nama</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/">Početna <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">O nama</a>
                    </li>
                @if(Auth::user() && Auth::user()->role->name == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="/users">Korisnici</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/roles">Role</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/currencies">Valute</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/income_categories">Kategorije prihoda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/incomes">Prihodi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/expense_categories">Kategorije troškova</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/expenses">Troškovi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/monthly_reports">Mesečni izveštaj</a>
                    </li>
                @endif
                @endguest
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Logovanje') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Registracija') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/home">Kontrolna tabla</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Izlogujte se') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>