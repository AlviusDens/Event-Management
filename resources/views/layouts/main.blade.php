<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="M!VENT - Temukan dan beli tiket event terbaik" />
    <meta name="author" content="M!VENT Team" />
    <title>@yield('title', 'M!VENT — Temukan Event Terbaik')</title>
    @vite(['resources/css/style.css'])
</head>
<body>
    <header>
        @include('partials.navbar')
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer-inner">
            <div class="footer-brand">
                <span class="footer-logo">M!VENT</span>
                <p>Platform tiket event terpercaya di Indonesia.</p>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 M!VENT. All rights reserved.</p>
                <a href="{{ route('admin.login') }}" class="footer-admin-link">Admin Portal</a>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 40) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Hamburger menu toggle
        document.getElementById('hamburger-btn')?.addEventListener('click', function() {
            document.querySelector('.menu')?.classList.toggle('menu-open');
            const icon = this.querySelector('.hamburger-icon');
            if (icon) icon.textContent = document.querySelector('.menu')?.classList.contains('menu-open') ? '✕' : '☰';
        });
    </script>

    @stack('scripts')
</body>
</html>
