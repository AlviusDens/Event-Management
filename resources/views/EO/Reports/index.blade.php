@extends('layouts.eo')

@section('title', 'Laporan Penjualan - M!VENT')

@section('content')
<div class="eo-dashboard">

    <!-- Topbar Header -->
    <div class="topbar">
        <div>
            <h1>Laporan Penjualan & Pendapatan</h1>
            <p class="subtitle">Rekapitulasi akumulasi transaksi tiket dan performa finansial seluruh event Anda.</p>
        </div>
        <div class="profile">
            {{ session('eo_nama', 'Event Organizer') }}
        </div>
    </div>

    <!-- 3 Metrics Cards -->
    <div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); margin-bottom: 28px;">
        <div class="stat-card">
            <h3>Total Transaksi Sukses</h3>
            <div class="value" style="color: #0284C7;">
                {{ number_format($overallSummary->total_transactions ?? 0, 0, ',', '.') }}
            </div>
            <p style="font-size: 13px; color: var(--eo-text-muted); margin-top: 4px;">Pesanan berhasil dibayar</p>
        </div>

        <div class="stat-card">
            <h3>Akumulasi Tiket Terjual</h3>
            <div class="value" style="color: #0D9488;">
                {{ number_format($totalTicketsSold ?? 0, 0, ',', '.') }}
                <span style="font-size: 15px; font-weight: normal; color: var(--eo-text-muted);">tiket</span>
            </div>
            <p style="font-size: 13px; color: var(--eo-text-muted); margin-top: 4px;">Dari seluruh event aktif</p>
        </div>

        <div class="stat-card">
            <h3>Total Pendapatan (Gross)</h3>
            <div class="value" style="color: #16A34A;">
                Rp {{ number_format($overallSummary->gross_revenue ?? 0, 0, ',', '.') }}
            </div>
            <p style="font-size: 13px; color: var(--eo-text-muted); margin-top: 4px;">Pendapatan kotor akumulatif</p>
        </div>
    </div>

    <!-- Table Card -->
    <div style="background: #FFFFFF; border-radius: 16px; border: 1px solid var(--eo-border); padding: 24px; box-shadow: var(--eo-shadow-sm);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div>
                <h2 style="font-size: 18px; font-weight: 700; color: var(--eo-text-dark); margin: 0;">Performa Per Event</h2>
                <p style="font-size: 13px; color: var(--eo-text-muted); margin: 4px 0 0;">Klik tombol aksi untuk melihat audit penjualan tiket per kategori.</p>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #F8FAFC; border-bottom: 2px solid #E2E8F0;">
                        <th style="padding: 14px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748B;">Nama Event</th>
                        <th style="padding: 14px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748B;">Jadwal Mulai</th>
                        <th style="padding: 14px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748B;">Status</th>
                        <th style="padding: 14px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748B;">Tiket Terjual</th>
                        <th style="padding: 14px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748B;">Total Pendapatan</th>
                        <th style="padding: 14px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748B; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($eventsReport as $ev)
                        @php
                            $st = strtolower($ev->status ?? 'draft');
                            $badgeClass = match($st) {
                                'published' => 'published',
                                'pending_review', 'pending' => 'pending',
                                'rejected' => 'rejected',
                                default => 'draft'
                            };
                            $badgeLabel = match($st) {
                                'published' => 'Published',
                                'pending_review', 'pending' => 'Pending Review',
                                'rejected' => 'Rejected',
                                default => 'Draft'
                            };
                        @endphp
                        <tr style="border-bottom: 1px solid #E2E8F0; transition: background-color 0.15s ease;" onmouseover="this.style.backgroundColor='#F8FAFC'" onmouseout="this.style.backgroundColor='transparent'">
                            <td style="padding: 14px 16px; font-weight: 600; color: var(--eo-text-dark);">
                                {{ $ev->event_name }}
                            </td>
                            <td style="padding: 14px 16px; font-size: 14px; color: var(--eo-text-muted);">
                                {{ $ev->start_time ? \Carbon\Carbon::parse($ev->start_time)->translatedFormat('d M Y, H:i') : '-' }}
                            </td>
                            <td style="padding: 14px 16px;">
                                <span class="status-badge {{ $badgeClass }}">
                                    {{ $badgeLabel }}
                                </span>
                            </td>
                            <td style="padding: 14px 16px; font-weight: 700; color: #0D9488;">
                                {{ number_format($ev->total_sold ?? 0, 0, ',', '.') }}
                            </td>
                            <td style="padding: 14px 16px; font-weight: 700; color: #16A34A;">
                                Rp {{ number_format($ev->event_revenue ?? 0, 0, ',', '.') }}
                            </td>
                            <td style="padding: 14px 16px; text-align: center;">
                                <a href="{{ route('eo.reports.sales', $ev->id) }}" style="display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; background: #38BDF8; color: #0C4A6E; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#0EA5E9'; this.style.color='#FFF'" onmouseout="this.style.background='#38BDF8'; this.style.color='#0C4A6E'">
                                    Detail Laporan →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 40px 16px; text-align: center; color: var(--eo-text-muted);">
                                <div style="font-size: 32px; margin-bottom: 8px;">📊</div>
                                <p style="font-weight: 600; color: var(--eo-text-dark); margin-bottom: 4px;">Belum Ada Data Penjualan</p>
                                <p style="font-size: 13px;">Laporan performa akan muncul di sini setelah tiket event Anda mulai terjual.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
