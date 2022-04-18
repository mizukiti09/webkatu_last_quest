<div id="header" class="l-header">
    <div class="l-header__inner u-inner">
        <div class="l-header__logo">
            <img class="u-img" src="{{ asset('images/logo.png') }}" alt="logo">
        </div>
        <nav class="l-header__nav">
            <ul class="l-header__nav--list">
                @guest @if (Route::has('login'))
                <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                @endif @if (Route::has('register'))
                <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @endif @else

                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
       {{ __('Logout') }}
   </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @endguest
            </ul>
        </nav>
    </div>
</div>