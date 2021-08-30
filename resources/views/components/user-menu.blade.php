<nav class="nav" aria-label="Navigation principale">
    <h2 class="nav__heading sr-only" role="heading" aria-level="2">Navigation principale</h2>
    <div class="nav__wrapper">
        <a href="{{ route('user.dashboard') }}" class="nav__link">Dashboard</a>
        <a href="{{ route('user.book.index') }}" class="nav__link">Commander</a>
        <a href="{{ route('user.order.index') }}" class="nav__link">Mes commandes</a>
    </div>
</nav>
