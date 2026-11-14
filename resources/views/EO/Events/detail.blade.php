@extends('layouts.eo')

@section('title', 'Detail Event — ' . $event->title)

@section('content')
<div class="detail-page-wrapper">
    <div class="detail-container">
        <!-- Tombol Kembali -->
        <a href="{{ route('eo.events.index') }}" class="btn-back">
            ← Kembali ke Daftar Event
        </a>

        <!-- Card Utama Event -->
        <div class="event-hero-card">
            @if ($event->banner_image)
            <div class="banner-wrapper">
                <img src="{{ asset('storage/' . $event->banner_image) }}" alt="{{ $event->title }}" class="banner-img" loading="lazy">
            </div>
            @endif

            <div class="event-hero-body">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 10px;">
                    @if ($category)
                    <span class="category-badge">{{ $category->name }}</span>
                    @endif

                    @php
                        $status = strtolower($event->status ?? 'draft');
                        $statusClass = match ($status) {
                            'published' => 'status-published',
                            'pending'   => 'status-pending',
                            'rejected', 'cancelled' => 'status-rejected',
                            default     => 'status-draft',
                        };
                    @endphp
                    <span class="event-status {{ $statusClass }}">
                        Status: {{ ucfirst($status) }}
                    </span>
                </div>

                <h1 class="event-title">{{ $event->title }}</h1>
                <p class="event-description">{{ $event->description }}</p>

                <div class="event-meta-grid">
                    <div class="meta-item">
                        <div class="meta-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <div>
                            <span class="meta-label">Waktu Mulai</span>
                            <strong class="meta-value">{{ \Carbon\Carbon::parse($event->start_time)->format('d M Y, H:i') }} WIB</strong>
                        </div>
                    </div>

                    <div class="meta-item">
                        <div class="meta-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <div>
                            <span class="meta-label">Waktu Selesai</span>
                            <strong class="meta-value">{{ \Carbon\Carbon::parse($event->end_time)->format('d M Y, H:i') }} WIB</strong>
                        </div>
                    </div>

                    <div class="meta-item meta-full">
                        <div class="meta-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <span class="meta-label">Lokasi Tempat</span>
                            <strong class="meta-value">{{ $event->venue_name }}, {{ $event->city }}</strong>
                            <span class="meta-label" style="margin-top: 4px; display: block;">{{ $event->address }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Tiket -->
        <div class="tickets-section">
            <h2 class="section-title">Pilihan Tiket & Kuota</h2>

            <div class="tickets-grid">
                @forelse ($tickets as $ticket)
                <div class="ticket-card">
                    <div class="ticket-info">
                        <h3 class="ticket-name">{{ $ticket->name }}</h3>
                        <p class="ticket-quota">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Kuota: {{ $ticket->quota }} tiket &nbsp;|&nbsp; Terjual: {{ $ticket->sold_quota ?? 0 }} tiket
                        </p>
                    </div>

                    <div class="ticket-action">
                        <span class="ticket-price">
                            @if ($ticket->price > 0)
                                Rp {{ number_format($ticket->price, 0, ',', '.') }}
                            @else
                                Gratis
                            @endif
                        </span>
                    </div>
                </div>
                @empty
                <div class="empty-tickets">
                    <p>Belum ada jenis tiket yang dibuat untuk event ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
