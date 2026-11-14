<aside class="sidebar" id="eoSidebar">
    <div class="sidebar-header">
        <a href="{{ route('eo.dashboard') }}" class="logo">
            M<span>!</span>VENT
        </a>
        <button type="button" class="sidebar-close-btn" id="sidebarCloseBtn" aria-label="Tutup Menu">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <div class="menu-title">Menu Utama</div>

    <a href="{{ route('eo.dashboard') }}" class="{{ request()->routeIs('eo.dashboard') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
        Dashboard
    </a>

    <a href="{{ route('eo.events.index') }}" class="{{ request()->routeIs('eo.events.index*') || request()->routeIs('eo.events.show*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 14l-5-5 1.41-1.41L12 14.17l7.59-7.59L21 8l-9 9z"/></svg>
        Daftar Event
    </a>

    <a href="{{ route('eo.events.create') }}" class="{{ request()->routeIs('eo.events.create') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
        Buat Event Baru
    </a>

    <a href="{{ route('eo.reports.index') }}" class="{{ request()->routeIs('eo.reports*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/></svg>
        Laporan Penjualan
    </a>

    <div class="menu-title">Kepanitiaan & Tim</div>

    <a href="{{ route('panitia.index') }}" class="{{ request()->routeIs('panitia*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
        Manajemen Panitia
    </a>

    <div class="menu-title">Akses Luar</div>

    <a href="{{ route('home') }}" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
        Halaman Publik ↗
    </a>

    <div class="sidebar-spacer"></div>

    <div class="sidebar-footer">
        <form id="logout-form" action="{{ route('eo.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <button type="button" class="sidebar-logout-btn" onclick="confirmLogout()">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
            Keluar (Logout)
        </button>
    </div>
</aside>

<!-- Backdrop overlay for mobile drawer -->
<div class="sidebar-backdrop" id="sidebarBackdrop"></div>
