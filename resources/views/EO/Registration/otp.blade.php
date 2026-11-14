@extends('layouts.eo')
@section('title', 'Verifikasi Email - M!VENT')
@section('content')

<div style="max-width: 460px; margin: 40px auto; padding: 0 16px;">
    <div style="background: #FFFFFF; border-radius: 18px; border: 1px solid #E2E8F0; padding: 36px 30px; box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05); text-align: center;">

        <div style="width: 56px; height: 56px; border-radius: 14px; background: #E0F2FE; color: #0284C7; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
            <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>

        <h1 style="font-size: 22px; font-weight: 700; color: #0F172A; margin-bottom: 8px;">Verifikasi Email Anda</h1>
        <p style="font-size: 14px; color: #64748B; line-height: 1.5; margin-bottom: 24px;">
            Kami telah mengirimkan 6 digit kode OTP ke alamat email Anda. Masukkan kode tersebut untuk melanjutkan aktivasi akun EO.
        </p>

        @if (session('error'))
            <div class="alert alert-error" style="text-align: left; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success" style="text-align: left; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('eo.otp.verify') }}" method="POST">
            @csrf

            <div class="form-group" style="text-align: left; margin-bottom: 24px;">
                <label for="otp" style="display: block; font-size: 13px; font-weight: 600; color: #0F172A; margin-bottom: 8px;">Kode OTP (6 Digit)</label>
                <input
                    type="text"
                    id="otp"
                    name="otp"
                    class="otp-input"
                    placeholder="Contoh: 123456"
                    inputmode="numeric"
                    pattern="[0-9]{6}"
                    maxlength="6"
                    required
                    style="width: 100%; text-align: center; font-size: 22px; letter-spacing: 0.3em; font-weight: 700; padding: 12px; border: 2px solid #E2E8F0; border-radius: 12px; outline: none; transition: border-color 0.2s;"
                    onfocus="this.style.borderColor='#38BDF8'"
                    onblur="this.style.borderColor='#E2E8F0'"
                >
            </div>

            <button type="submit" style="width: 100%; padding: 14px; font-size: 15px; font-weight: 600; background: #38BDF8; color: #0C4A6E; border: none; border-radius: 12px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#0EA5E9'; this.style.color='#FFF'" onmouseout="this.style.background='#38BDF8'; this.style.color='#0C4A6E'">
                Verifikasi & Lanjutkan
            </button>
        </form>

    </div>
</div>
@endsection
