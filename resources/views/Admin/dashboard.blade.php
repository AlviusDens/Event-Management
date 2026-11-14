@extends('layouts.admin')
@section('title', 'Dashboard Admin — M!VENT')
@section('content')

<div class="header">
    <h1>Dashboard Administrator</h1>
    <p>Selamat datang di panel kendali platform M!VENT.</p>
</div>

<!-- STATISTIK PLATFORM -->
<div class="stats">
    <div class="stat-card">
        <div class="stat-title">Total Event</div>
        <div class="stat-number">{{ $data['total_event'] ?? 0 }}</div>
    </div>

    <div class="stat-card" style="border-left: 4px solid #F59E0B;">
        <div class="stat-title">Event Menunggu Review</div>
        <div class="stat-number" style="color: #D97706;">{{ $data['event_pending'] ?? 0 }}</div>
    </div>

    <div class="stat-card">
        <div class="stat-title">Total Event Organizer</div>
        <div class="stat-number">{{ $data['total_eo'] ?? 0 }}</div>
    </div>

    <div class="stat-card" style="border-left: 4px solid #38BDF8;">
        <div class="stat-title">Tiket Terjual</div>
        <div class="stat-number" style="color: #0284C7;">{{ $data['total_tiket'] ?? 0 }}</div>
    </div>
</div>

<!-- MENU KELOLA ADMIN -->
<div class="menu-container">
    <div class="menu-card">
        <h3>📋 Verifikasi EO (KYC)</h3>
        <p>
            Periksa dokumen identitas (KTP, NPWP) dan rekening bank yang diajukan oleh Event Organizer.
        </p>
        <a href="{{ route('admin.kyc.index') }}" class="btn btn-primary">
            Periksa Dokumen KYC →
        </a>
    </div>

    <div class="menu-card">
        <h3>🎪 Verifikasi Event</h3>
        <p>
            Tinjau kelayakan detail event, jadwal, dan kuota tiket sebelum diterbitkan secara publik.
        </p>
        <a href="{{ route('admin.event-verification.index') }}" class="btn btn-primary">
            Periksa Pengajuan Event →
        </a>
    </div>

    <div class="menu-card">
        <h3>📊 Laporan & Monitoring</h3>
        <p>
            Pantau arus transaksi tiket, status event, dan kepatuhan penyelenggara di seluruh sistem.
        </p>
        <span style="font-size: 13px; color: #94A3B8; font-weight: 500;">
            ✓ Real-time monitoring aktif
        </span>
    </div>
</div>

@endsection
