@extends('layouts.eo')

@section('title', 'Buat Event Baru — M!VENT')

@section('content')
<div class="form-container-wide">

    <div class="page-title" style="margin-bottom: 28px;">
        <h1 style="font-size: 28px; font-weight: 800; color: #0F172A; margin-bottom: 6px;">Buat Event Baru</h1>
        <p style="color: #64748B; font-size: 15px;">Lengkapi informasi event dan tentukan jenis tiket sebelum diajukan untuk verifikasi.</p>
    </div>

    @if ($errors->any())
    <div class="alert alert-error">
        <strong>Periksa kembali data berikut:</strong>
        <ul style="margin-top: 6px; padding-left: 18px; list-style: disc;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('eo.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 1. INFORMASI EVENT -->
        <section class="form-section-card">
            <h3 class="form-section-title">1. Informasi Event</h3>

            <div class="form-group">
                <label for="title">Nama Event *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Contoh: Sound of Summer 2026" required>
            </div>

            <div class="form-group">
                <label for="category_id">Kategori Event *</label>
                <select id="category_id" name="category_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Event *</label>
                <textarea id="description" name="description" placeholder="Jelaskan detail acara, line-up artis, dan informasi penting lainnya..." required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="banner_image">Banner Event *</label>
                <input type="file" id="banner_image" name="banner_image" accept=".jpg,.jpeg,.png" required>
                <p style="color: #94A3B8; font-size: 12px; margin-top: 6px;">Format file: JPG, JPEG, atau PNG. Ukuran maksimal 2 MB.</p>
            </div>
        </section>

        <!-- 2. LOKASI EVENT -->
        <section class="form-section-card">
            <h3 class="form-section-title">2. Lokasi Event</h3>

            <div class="form-group">
                <label for="venue_name">Nama Tempat / Venue *</label>
                <input type="text" id="venue_name" name="venue_name" value="{{ old('venue_name') }}" placeholder="Contoh: Stadion Utama Gelora Bung Karno" required>
            </div>

            <div class="form-group">
                <label for="city">Kota *</label>
                <input type="text" id="city" name="city" value="{{ old('city') }}" placeholder="Contoh: Jakarta Pusat" required>
            </div>

            <div class="form-group">
                <label for="address">Alamat Lengkap *</label>
                <textarea id="address" name="address" placeholder="Tuliskan alamat lengkap beserta patokan lokasi..." required>{{ old('address') }}</textarea>
            </div>
        </section>

        <!-- 3. WAKTU -->
        <section class="form-section-card">
            <h3 class="form-section-title">3. Jadwal Event</h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px;">
                <div class="form-group">
                    <label for="start_time">Waktu Mulai *</label>
                    <input type="datetime-local" id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                </div>

                <div class="form-group">
                    <label for="end_time">Waktu Selesai *</label>
                    <input type="datetime-local" id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                </div>
            </div>
        </section>

        <!-- 4. TIKET DAN KUOTA -->
        <section class="form-section-card">
            <h3 class="form-section-title">4. Jenis Tiket dan Kuota</h3>

            <div id="ticket-container" data-initial-count="{{ count(old('tickets', [])) > 0 ? count(old('tickets', [])) : 1 }}">
                <div class="ticket-card-item">
                    <div class="ticket-header">
                        <span class="ticket-title">Jenis Tiket #1</span>
                    </div>

                    <div class="ticket-form-grid">
                        <div class="form-group">
                            <label>Nama Tiket <span style="color:#EF4444;">*</span></label>
                            <input type="text" name="tickets[0][name]" placeholder="Contoh: Early Bird / Presale / VIP" required>
                        </div>

                        <div class="form-group">
                            <label>Harga Tiket (Rp) <span style="color:#EF4444;">*</span></label>
                            <input type="number" name="tickets[0][price]" placeholder="0 jika Gratis" min="0" required>
                        </div>

                        <div class="form-group">
                            <label>Kuota Tiket <span style="color:#EF4444;">*</span></label>
                            <input type="number" name="tickets[0][quota]" placeholder="Contoh: 100" min="1" required>
                        </div>

                        <div class="form-group">
                            <label>Maksimal Tiket / Transaksi <span style="color:#EF4444;">*</span></label>
                            <input type="number" name="tickets[0][max_per_order]" value="5" min="1" required>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn-add-ticket" id="add-ticket">
                + Tambah Jenis Tiket
            </button>
        </section>

        <!-- TOMBOL AKSI -->
        <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 32px; margin-bottom: 20px;">
            <a href="{{ route('eo.events.index') }}" class="btn" style="background: #F1F5F9; color: #475569; padding: 12px 24px; border-radius: 8px; font-weight: 600; text-decoration: none; border: 1px solid #E2E8F0;">
                Batal
            </a>
            <button type="submit" class="btn" style="background: #38BDF8; color: #0C4A6E; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 700; cursor: pointer; width: auto;">
                Simpan & Ajukan Event
            </button>
        </div>

    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('ticket-container');
        const addButton = document.getElementById('add-ticket');

        let ticketIndex = parseInt(container.getAttribute('data-initial-count')) || 1;

        window.updateTicketNumbers = function() {
            const cards = container.querySelectorAll('.ticket-card-item');
            cards.forEach((card, index) => {
                const titleSpan = card.querySelector('.ticket-title');
                if (titleSpan) {
                    titleSpan.textContent = 'Jenis Tiket #' + (index + 1);
                }
                const removeButton = card.querySelector('.btn-remove-ticket');
                if (removeButton) {
                    if (cards.length === 1) {
                        removeButton.disabled = true;
                        removeButton.style.opacity = '0.5';
                        removeButton.style.cursor = 'not-allowed';
                    } else {
                        removeButton.disabled = false;
                        removeButton.style.opacity = '1';
                        removeButton.style.cursor = 'pointer';
                    }
                }
            });
        };

        window.removeTicketItem = function(button) {
            const cards = container.querySelectorAll('.ticket-card-item');
            if (cards.length > 1) {
                button.closest('.ticket-card-item').remove();
                window.updateTicketNumbers();
            }
        };

        if (addButton) {
            addButton.addEventListener('click', function() {
                const card = document.createElement('div');
                card.className = 'ticket-card-item';

                card.innerHTML = `
                    <div class="ticket-header">
                        <span class="ticket-title">Jenis Tiket #${ticketIndex + 1}</span>
                        <button type="button" class="btn-remove-ticket" onclick="removeTicketItem(this)">Hapus</button>
                    </div>

                    <div class="ticket-form-grid">
                        <div class="form-group">
                            <label>Nama Tiket <span style="color:#EF4444;">*</span></label>
                            <input type="text" name="tickets[${ticketIndex}][name]" placeholder="Contoh: Reguler / VIP" required>
                        </div>

                        <div class="form-group">
                            <label>Harga Tiket (Rp) <span style="color:#EF4444;">*</span></label>
                            <input type="number" name="tickets[${ticketIndex}][price]" placeholder="0 jika Gratis" min="0" required>
                        </div>

                        <div class="form-group">
                            <label>Kuota Tiket <span style="color:#EF4444;">*</span></label>
                            <input type="number" name="tickets[${ticketIndex}][quota]" placeholder="Contoh: 100" min="1" required>
                        </div>

                        <div class="form-group">
                            <label>Maksimal Tiket / Transaksi <span style="color:#EF4444;">*</span></label>
                            <input type="number" name="tickets[${ticketIndex}][max_per_order]" value="5" min="1" required>
                        </div>
                    </div>
                `;

                container.appendChild(card);
                ticketIndex++;
                window.updateTicketNumbers();
            });
        }

        window.updateTicketNumbers();
    });
</script>
@endsection
