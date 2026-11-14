@extends('layouts.eo')

@section('title', 'Laporan Penjualan - ' . $event->title . ' - M!VENT')

@section('content')
<div class="eo-dashboard">

    <!-- Topbar Header -->
    <div class="topbar">
        <div>
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                <a href="{{ route('eo.reports.index') }}" style="color: #64748B; text-decoration: none; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                    ← Kembali ke Daftar Laporan
                </a>
            </div>
            <h1>{{ $event->title }}</h1>
            <p class="subtitle">
                📍 {{ $event->venue_name }} &nbsp;|&nbsp; 🗓️ {{ \Carbon\Carbon::parse($event->start_time)->translatedFormat('l, d F Y - H:i') }} WIB
            </p>
        </div>
        <div class="profile">
            <button onclick="window.print()" class="btn-create" style="padding: 10px 18px; font-size: 14px; gap: 6px;">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd"/>
                </svg>
                Cetak / Ekspor PDF
            </button>
        </div>
    </div>

    <!-- 3 Metric Cards -->
    <div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); margin-bottom: 28px;">
        <div class="stat-card">
            <h3>Total Transaksi Sukses</h3>
            <div class="value" style="color: #0284C7;">
                {{ number_format($salesSummary->total_transactions ?? 0, 0, ',', '.') }}
                <span style="font-size: 14px; font-weight: normal; color: var(--eo-text-muted);">pesanan</span>
            </div>
            <p style="font-size: 13px; color: var(--eo-text-muted); margin-top: 4px;">Telah dibayar & terverifikasi</p>
        </div>

        <div class="stat-card">
            <h3>Total Pendapatan (Gross)</h3>
            <div class="value" style="color: #16A34A;">
                Rp {{ number_format($salesSummary->gross_revenue ?? 0, 0, ',', '.') }}
            </div>
            <p style="font-size: 13px; color: var(--eo-text-muted); margin-top: 4px;">Akumulasi penjualan sebelum potongan</p>
        </div>

        <div class="stat-card">
            <h3>Pendapatan Bersih (Net)</h3>
            <div class="value" style="color: #0F172A;">
                Rp {{ number_format($salesSummary->net_revenue ?? 0, 0, ',', '.') }}
            </div>
            <p style="font-size: 13px; color: var(--eo-text-muted); margin-top: 4px;">Hasil estimasi pencairan EO</p>
        </div>
    </div>

    <!-- Ticket Categories Performance Table -->
    <div style="background: #FFFFFF; border-radius: 16px; border: 1px solid var(--eo-border); padding: 24px; box-shadow: var(--eo-shadow-sm);">
        <h2 style="font-size: 18px; font-weight: 700; color: var(--eo-text-dark); margin-bottom: 16px;">
            Performa Penjualan Kategori Tiket
        </h2>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #F8FAFC; border-bottom: 2px solid #E2E8F0;">
                        <th style="padding: 14px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748B;">Jenis Tiket</th>
                        <th style="padding: 14px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748B;">Harga Satuan</th>
                        <th style="padding: 14px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748B;">Total Kuota</th>
                        <th style="padding: 14px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748B;">Terjual</th>
                        <th style="padding: 14px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748B;">Sisa Kuota</th>
                        <th style="padding: 14px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748B;">Penjualan</th>
                        <th style="padding: 14px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748B; text-align: right;">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ticketPerformances as $tp)
                        @php
                            $pct = $tp->quota > 0 ? round(($tp->sold_quota / $tp->quota) * 100) : 0;
                        @endphp
                        <tr style="border-bottom: 1px solid #E2E8F0; transition: background-color 0.15s ease;" onmouseover="this.style.backgroundColor='#F8FAFC'" onmouseout="this.style.backgroundColor='transparent'">
                            <td style="padding: 14px 16px; font-weight: 700; color: var(--eo-text-dark);">
                                {{ $tp->ticket_name }}
                            </td>
                            <td style="padding: 14px 16px; font-size: 14px; color: var(--eo-text-dark);">
                                Rp {{ number_format($tp->price, 0, ',', '.') }}
                            </td>
                            <td style="padding: 14px 16px; font-weight: 600; color: #64748B;">
                                {{ number_format($tp->quota, 0, ',', '.') }}
                            </td>
                            <td style="padding: 14px 16px; font-weight: 700; color: #16A34A;">
                                {{ number_format($tp->sold_quota, 0, ',', '.') }}
                            </td>
                            <td style="padding: 14px 16px; font-weight: 600; color: #0284C7;">
                                {{ number_format($tp->available_quota, 0, ',', '.') }}
                            </td>
                            <td style="padding: 14px 16px; min-width: 140px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="flex: 1; height: 8px; background: #E2E8F0; border-radius: 9999px; overflow: hidden;">
                                        <div style="width: {{ $pct }}%; height: 100%; background: #38BDF8; border-radius: 9999px;"></div>
                                    </div>
                                    <span style="font-size: 12px; font-weight: 600; color: var(--eo-text-muted);">{{ $pct }}%</span>
                                </div>
                            </td>
                            <td style="padding: 14px 16px; font-weight: 700; color: #16A34A; text-align: right;">
                                Rp {{ number_format($tp->total_revenue_by_type, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="padding: 30px; text-align: center; color: var(--eo-text-muted);">
                                Belum ada jenis tiket untuk event ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
