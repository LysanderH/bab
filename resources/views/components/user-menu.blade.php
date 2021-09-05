<nav class="nav" aria-label="Navigation principale">
    <h2 class="sr-only nav__heading" role="heading" aria-level="2">Navigation principale</h2>
    <label for="menu" class="nav__label nav__label--open">@include('icons.menu')<span class="sr-only">Ouvrir le
            menu</span></label>
    <input type="checkbox" id="menu" class="nav__checkbox">
    <div class="nav__wrapper">
        <label for="menu" class="nav__label nav__label--close">>@include('icons.cross')<span class="sr-only">Fermer
                le
                menu</span></label>
        <a href="{{ route('student.dashboard') }}" class="nav__link">Dashboard</a>
        <a href="{{ route('student.order.create') }}" class="nav__link">Commander</a>
        <a href="{{ route('student.order.index') }}" class="nav__link">Mes commandes</a>
        <a href="{{ route('student.profile') }}" class="nav__link">Mon compte</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav__link">
            Se déconnecter
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
    </div>
</nav>
