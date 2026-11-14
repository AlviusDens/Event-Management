@extends('layouts.eo')

@section('title', 'Dashboard EO — M!VENT')

@section('content')

    <!-- TOPBAR -->
    <div class="topbar">
        <div>
            <h1>Dashboard EO</h1>
            <p class="subtitle">Kelola event dan pantau aktivitas penjualan tiket kamu secara real-time.</p>
        </div>

        <div class="profile">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
            {{ session('eo_nama', 'Event Organizer') }}
        </div>
    </div>

    <!-- NOTIFIKASI -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <!-- KARTU STATISTIK -->
    <div class="stats">
        <div class="stat-card">
            <p>Total Event</p>
            <h2>{{ $stats['total_event'] ?? 0 }}</h2>
        </div>

        <div class="stat-card">
            <p>Tiket Terjual</p>
            <h2>{{ $stats['tiket_terjual'] ?? 0 }}</h2>
        </div>

        <div class="stat-card">
            <p>Total Pendapatan</p>
            <h2>Rp {{ number_format($stats['pendapatan'] ?? 0, 0, ',', '.') }}</h2>
        </div>

        <div class="stat-card">
            <p>Peserta Hadir</p>
            <h2>{{ $stats['peserta_hadir'] ?? 0 }}</h2>
        </div>
    </div>

    <!-- SECTION EVENT SAYA -->
    <div class="section">
        <div class="section-header">
            <h2>Event Saya</h2>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <a href="{{ route('panitia.index') }}" class="btn" style="background-color: #F1F5F9; color: #475569; border: 1px solid #E2E8F0;">
                    👥 Kelola Panitia
                </a>
                <a href="{{ route('eo.events.create') }}" class="btn" style="background-color: #38BDF8; color: #0C4A6E; font-weight: 700;">
                    + Buat Event
                </a>
            </div>
        </div>

        @forelse ($events as $event)
            <div class="event-item">
                <div style="display: flex; align-items: center; gap: 20px; flex: 1; min-width: 0;">
                    @if (!empty($event->banner_image) || !empty($event->foto))
                        <div class="event-image-wrapper" style="flex-shrink: 0;">
                            <img src="{{ asset('storage/' . ($event->banner_image ?? $event->foto)) }}"
                                alt="{{ $event->title ?? $event->nama }}"
                                style="width: 130px; height: 85px; object-fit: cover; border-radius: 10px; border: 1.5px solid #E2E8F0;"
                                loading="lazy">
                        </div>
                    @endif

                    <div class="event-info" style="min-width: 0;">
                        <h3>{{ $event->title ?? ($event->nama ?? 'Event tanpa judul') }}</h3>

                        <p>
                            📅
                            @if (!empty($event->start_time))
                                {{ \Carbon\Carbon::parse($event->start_time)->translatedFormat('d F Y, H:i') }}
                            @elseif (!empty($event->tanggal))
                                {{ $event->tanggal }}
                            @else
                                Jadwal belum diatur
                            @endif

                            &nbsp;•&nbsp; 📍
                            @if (!empty($event->venue_name))
                                {{ $event->venue_name }}{{ !empty($event->city) ? ', ' . $event->city : '' }}
                            @elseif (!empty($event->lokasi))
                                {{ $event->lokasi }}
                            @else
                                Lokasi belum diatur
                            @endif
                        </p>

                        <p>🎟 {{ $event->tiket_terjual ?? 0 }} tiket terjual</p>

                        <!-- TOMBOL AKSI: LIHAT DETAIL & LIHAT LAPORAN -->
                        <div style="display: flex; gap: 12px; margin-top: 10px; align-items: center; flex-wrap: wrap;">
                            <a href="{{ route('eo.events.show', $event->id) }}" class="detail-btn">
                                Lihat Detail →
                            </a>

                            <a href="{{ route('eo.reports.sales', $event->id) }}" class="btn" style="background-color: #F0F9FF; color: #0369A1; border: 1px solid #BAE6FD; padding: 6px 14px; border-radius: 6px; font-size: 13px; text-decoration: none; font-weight: 600;">
                                📊 Lihat Laporan
                            </a>
                        </div>
                    </div>
                </div>

                @php
                    $status = strtolower($event->status ?? 'draft');
                    $statusClass = match ($status) {
                        'published' => 'status-published',
                        'pending' => 'status-pending',
                        'rejected', 'cancelled' => 'status-rejected',
                        default => 'status-draft',
                    };
                @endphp

                <div class="event-status {{ $statusClass }}" style="flex-shrink: 0;">
                    {{ ucfirst($status) }}
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 50px 20px; color: #64748B;">
                <div style="font-size: 36px; margin-bottom: 12px;">🎪</div>
                <p style="margin-bottom: 6px; font-weight: 600; color: #0F172A; font-size: 16px;">Belum ada event yang dibuat.</p>
                <p style="font-size: 13px;">Klik tombol <strong>+ Buat Event</strong> untuk mulai menjual tiket event kamu.</p>
            </div>
        @endforelse
    </div>

@endsection
