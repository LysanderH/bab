<nav class="nav" aria-label="Navigation principale">
    <h2 class="nav__heading sr-only" role="heading" aria-level="2">Navigation principale</h2>
    <div class="nav__wrapper">
        <a href="{{ route('student.dashboard') }}" class="nav__link">Dashboard</a>
        <a href="{{ route('student.order.create') }}" class="nav__link">Commander</a>
        <a href="{{ route('student.order.index') }}" class="nav__link">Mes commandes</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Se déconnecter
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
    </div>
</nav>
