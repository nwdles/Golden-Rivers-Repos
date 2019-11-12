
<div class="navbar navbar-dark bg-dark box-shadow">
    <div class="container d-flex justify-content-between">
        <a href="{{ route('index') }}" class="navbar-brand d-flex align-items-center">
            <strong>Золотые реки</strong>
        </a>
        <a href="{{ route('index') }}" class="navbar-brand d-flex align-items-center">
            |
        </a>
        <a href="{{ route('shows') }}" class="navbar-brand d-flex align-items-center">
            <strong>Выставки</strong>
        </a>
        <a href="{{ route('index') }}" class="navbar-brand d-flex align-items-center">
            |
        </a>
        <a href="{{ route('auctions') }}" class="navbar-brand d-flex align-items-center">
            <strong>Аукционы</strong>
        </a>
        <a href="{{ route('index') }}" class="navbar-brand d-flex align-items-center">
            |
        </a>
        @if(Auth::check() && Auth::user()->isAdmin())
        <a href="{{ route('admin.panel') }}" class="navbar-brand d-flex align-items-center">
            <strong>Панель Администратора</strong>
        </a>
        <a href="{{ route('index') }}" class="navbar-brand d-flex align-items-center">
            |
        @endif
        @if(Auth::check())
        </a>
        <a href="{{ route('lk') }}" class="navbar-brand d-flex align-items-center">
            <strong>Личный кабинет</strong>
        </a>
        @endif
        @guest
            <a href="{{ route('login') }}  "class="navbar-brand d-flex align-items-center">Войти</a>
            <a href="{{ route('register') }}"class="navbar-brand d-flex align-items-center">Регистрация</a>
        @else



                        <a href="{{ route('logout') }}" class="navbar-brand d-flex align-items-center"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Выйти
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

        @endguest
    </div>
</div>