@extends('layouts.main')
@section('title', 'M!VENT — Temukan Event Terbaik')
@section('content')

<section class="hero">
    <div class="hero-grid-pattern" aria-hidden="true"></div>

    <div class="hero-content">
        <span class="hero-eyebrow">
            <span class="hero-eyebrow-dot"></span>
            Platform Tiket Event Terpercaya
        </span>

        <h1>Temukan Event <span class="hero-highlight">Menarik</span> di Sekitarmu</h1>
        <p>Cari, filter kategori, dan amankan tiket event favoritmu — mulai dari konser musik, seminar, hingga festival.</p>

        {{-- Form Pencarian & Filter Kategori --}}
        <form action="{{ route('home') }}" method="GET" class="search-form">
            <div class="search-input-box">
                <svg class="search-input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input
                    type="text"
                    name="keyword"
                    class="search"
                    placeholder="Cari nama event, lokasi, atau penyelenggara..."
                    value="{{ request('keyword') }}">
            </div>

            <span class="search-divider" aria-hidden="true"></span>

            <select name="category" class="filter-select" aria-label="Pilih Kategori Event">
                <option value="">Semua Kategori</option>
                @foreach ($event_categories as $category)
                <option value="{{ $category->id }}" {{ (string) request('category') === (string) $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>

            <button type="submit" class="btn-search">
                Cari Event
            </button>
        </form>

        {{-- Quick Category Filter Pills --}}
        @if ($event_categories->count() > 0)
        <div class="category-pills">
            <a href="{{ route('home', array_filter(['keyword' => request('keyword')])) }}"
                class="category-pill {{ !request('category') ? 'active' : '' }}">
                Semua Event
            </a>
            @foreach ($event_categories as $category)
            <a href="{{ route('home', array_filter(['category' => $category->id, 'keyword' => request('keyword')])) }}"
                class="category-pill {{ (string) request('category') === (string) $category->id ? 'active' : '' }}">
                {{ $category->name }}
            </a>
            @endforeach
        </div>
        @endif
    </div>
</section>

<section id="katalog-event" class="event-section">
    <div class="event-section-header">
        <div>
            <h2>
                @if (request('keyword') || request('category'))
                Hasil Pencarian Event
                @else
                Event Terbaru
                @endif
            </h2>
            <p class="event-section-subtitle">
                Menampilkan {{ $events->count() }} event aktif siap dipesan
            </p>
        </div>

        @if (request('keyword') || request('category'))
        <a href="{{ route('home') }}" class="clear-filter">
            ✕ Reset Filter
        </a>
        @endif
    </div>

    <div class="event-container">
        @forelse ($events as $index => $event)
        @php
        $eventTitle = $event->title ?? $event->nama ?? 'Event Tanpa Judul';
        $eventDate = $event->start_time ?? $event->tanggal ?? null;
        $eventLocation = collect([$event->venue_name ?? null, $event->city ?? null])->filter()->implode(', ');
        if (empty($eventLocation)) {
        $eventLocation = $event->location ?? 'Lokasi menyusul';
        }

        $imagePath = null;
        if (!empty($event->banner_image)) {
        $imagePath = \Illuminate\Support\Str::startsWith($event->banner_image, ['http://', 'https://'])
        ? $event->banner_image
        : asset('storage/' . $event->banner_image);
        } elseif (!empty($event->foto)) {
        $imagePath = asset('assets/img/events/' . $event->foto);
        }

        $categoryName = $event->category->name
        ?? $event->category_name
        ?? ($event_categories->firstWhere('id', $event->category_id)->name ?? null);

        $minPrice = $event->tickets_min_price
        ?? (method_exists($event, 'relationLoaded') && $event->relationLoaded('tickets') ? $event->tickets->min('price') : null)
        ?? $event->harga
        ?? null;
        @endphp

        <article class="event-card reveal-on-scroll" data-delay="{{ min($index * 60, 360) }}">
            <div class="event-image">
                @if ($categoryName)
                <span class="event-card-badge">{{ $categoryName }}</span>
                @endif

                @if ($imagePath)
                <img src="{{ $imagePath }}" alt="{{ $eventTitle }}" loading="lazy">
                @else
                <div class="event-image-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="3" ry="3"></rect>
                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                        <polyline points="21 15 16 10 5 21"></polyline>
                    </svg>
                    <span>Poster Event</span>
                </div>
                @endif
            </div>

            <div class="event-content">
                <h3>{{ $eventTitle }}</h3>

                <div class="event-meta-list">
                    <p class="event-meta-date">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span>{{ $eventDate ? \Carbon\Carbon::parse($eventDate)->translatedFormat('d F Y') : 'Jadwal menyusul' }}</span>
                    </p>

                    <p class="event-meta-loc">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span>{{ $eventLocation }}</span>
                    </p>
                </div>

                <div class="event-card-footer">
                    <div class="price">
                        @if ($minPrice !== null && (float) $minPrice > 0)
                        <span class="price-prefix">Mulai dari</span>
                        Rp {{ number_format($minPrice, 0, ',', '.') }}
                        @elseif ($minPrice !== null && (float) $minPrice === 0.0)
                        <span class="price-free">Gratis</span>
                        @else
                        <span class="price-prefix">Tiket</span>
                        Tersedia
                        @endif
                    </div>

                    <a href="{{ route('events.show', $event->slug) }}" class="btn-detail">
                        Lihat Detail <span class="arrow-icon">→</span>
                    </a>
                </div>
            </div>
        </article>
        @empty
        <div class="events-empty">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" stroke="#94A3B8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="margin: 0 auto;">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <h3>Tidak ada event yang ditemukan</h3>
            <p>Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
            @if (request('keyword') || request('category'))
            <a href="{{ route('home') }}" class="btn-detail" style="margin-top: 16px;">Lihat Semua Event</a>
            @endif
        </div>
        @endforelse
    </div>
</section>

<script>
    document.querySelectorAll('.reveal-on-scroll[data-delay]').forEach((card) => {
        card.style.transitionDelay = `${card.dataset.delay}ms`;
    });
</script>

@endsection