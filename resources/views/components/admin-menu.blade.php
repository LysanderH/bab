<nav class="nav" aria-label="Navigation principale">
    <h2 class="nav__heading sr-only" role="heading" aria-level="2">Navigation principale</h2>
    <div class="nav__wrapper">
        <a href="{{ route('admin.dashboard') }}" class="nav__link">Dashboard</a>
        <a href="{{ route('admin.book.index') }}" class="nav__link">Livres</a>
        <a href="{{ route('admin.user.index') }}" class="nav__link">Utilisateurs</a>
        <a href="{{ route('admin.order.index') }}" class="nav__link">Commandes</a>
        <a href="{{ route('admin.setting.index') }}" class="nav__link">Préférences</a>
    </div>
</nav>
