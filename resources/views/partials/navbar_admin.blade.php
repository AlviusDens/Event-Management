<nav>
    <div class="logo">M!VENT</div>

    <div class="admin-area">
        <span class="admin-name">
            Halo, {{ session('admin_name', 'Administrator') }}
        </span>

        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.kyc.index') }}">Pemeriksaan KYC</a>
        <a href="{{ route('admin.event-verification.index') }}">Verifikasi Event</a>

        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <button type="button" onclick="confirmAdminLogout()" class="btn btn-dark">
            Logout
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmAdminLogout() {
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: "Apakah Anda yakin ingin keluar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#38BDF8',
                cancelButtonColor: '#94A3B8',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
</nav>
