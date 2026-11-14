@extends('layouts.eo')
@section('title', 'Menunggu Verifikasi - M!VENT')
@section('content')

<div style="max-width: 500px; margin: 40px auto; padding: 0 16px;">
    <div style="background: #FFFFFF; border-radius: 20px; border: 1px solid #E2E8F0; padding: 40px 32px; box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05); text-align: center;">

        <div style="width: 64px; height: 64px; border-radius: 50%; background: #FEF3C7; color: #D97706; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
            <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>

        <h1 style="font-size: 24px; font-weight: 700; color: #0F172A; margin-bottom: 8px;">Pengajuan Terkirim!</h1>

        <div style="display: inline-block; padding: 6px 14px; border-radius: 9999px; background: #FEF3C7; color: #92400E; font-size: 13px; font-weight: 600; margin-bottom: 20px;">
            Menunggu Verifikasi Admin (Pending)
        </div>

        <p style="font-size: 14px; color: #64748B; line-height: 1.6; margin-bottom: 20px;">
            Berkas pendaftaran KYC Event Organizer Anda telah kami terima. Tim Administrator M!VENT sedang memeriksa kelayakan dokumen identitas (KTP & NPWP) Anda.
        </p>

        <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 14px 16px; font-size: 13px; color: #475569; text-align: left; line-height: 1.5; margin-bottom: 28px;">
            💡 <strong>Catatan:</strong> Hasil verifikasi akan kami kirimkan ke email Anda dalam waktu 1x24 jam kerja. Setelah disetujui, akun Anda dapat langsung membuat dan menjual tiket event.
        </div>

        <a href="{{ route('home') }}" style="display: block; width: 100%; padding: 14px; font-size: 15px; font-weight: 600; background: #38BDF8; color: #0C4A6E; border-radius: 12px; text-decoration: none; text-align: center; transition: all 0.2s;" onmouseover="this.style.background='#0EA5E9'; this.style.color='#FFF'" onmouseout="this.style.background='#38BDF8'; this.style.color='#0C4A6E'">
            Kembali ke Halaman Utama
        </a>

    </div>
</div>
@endsection
