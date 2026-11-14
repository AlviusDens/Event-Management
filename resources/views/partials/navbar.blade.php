<nav id="navbar">
    {{-- Hamburger button (mobile only) --}}
    <button id="hamburger-btn" class="hamburger-btn" aria-label="Toggle menu" type="button">
        <span class="hamburger-icon">☰</span>
    </button>

    {{-- Left: Menu items --}}
    <div class="menu">
        <a href="{{ route('eo.login') }}" class="btn-masuk">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
            </svg>
            Login EO
        </a>

        <a href="{{ route('eo.register') }}" class="btn-eo">
            Daftar sebagai EO
        </a>

        <a href="{{ route('home') }}#katalog-event" class="nav-link-item">
            Jelajahi Event
        </a>
    </div>

    {{-- Right: Logo --}}
    <div class="logo">
        <a href="{{ route('home') }}">M<span class="logo-accent">!</span>VENT</a>
    </div>
</nav>