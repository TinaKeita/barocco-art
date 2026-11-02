<header class="site-header">
    <nav class="nav">
        <a href="{{ route('home') }}" class="logo">Barocco Art</a>
        <div class="nav-links">
            <a href="{{ route('service', 'celtnieciba') }}" class="{{ request()->is('pakalpojumi/celtnieciba') ? 'is-active' : '' }}">Celtniecība</a>
            <a href="{{ route('service', 'projektesana') }}" class="{{ request()->is('pakalpojumi/projektesana') ? 'is-active' : '' }}">Projektēšana</a>
            <a href="{{ route('service', 'interjera-dizains') }}" class="{{ request()->is('pakalpojumi/interjera-dizains') ? 'is-active' : '' }}">Interjera dizains</a>
            <a href="{{ route('service', 'mebeles') }}" class="{{ request()->is('pakalpojumi/mebeles') ? 'is-active' : '' }}">Mēbeles</a>
            <a href="{{ route('contacts') }}" class="{{ request()->routeIs('contacts') ? 'is-active' : '' }}">Kontakti</a>
        </div>
    </nav>
</header>