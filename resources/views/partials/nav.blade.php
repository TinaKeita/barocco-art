<header class="site-header">
    <nav class="nav">
        {{-- logo goes back to home page --}}
        <a href="{{ route('home') }}" class="logo">Barocco Art</a>

        <div class="nav-links">
            {{-- menu links come from the sections table --}}
            @foreach ($navSections as $navSection)
                <a href="{{ route('service', $navSection->slug) }}"
                   class="{{ request()->is('pakalpojumi/' . $navSection->slug) ? 'is-active' : '' }}">
                    {{ $navSection->label }}
                </a>
            @endforeach

            {{-- contacts is not a section so its added by hand --}}
            <a href="{{ route('contacts') }}"
               class="{{ request()->routeIs('contacts') ? 'is-active' : '' }}">Kontakti</a>
        </div>
    </nav>
</header>
