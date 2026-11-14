@extends('layouts.eo')
@section('title', 'Lengkapi Profil EO — M!VENT')
@section('content')

<div class="container" style="max-width: 600px;">
    <h1>Lengkapi Profil EO</h1>

    <p class="subtitle">
        Lengkapi data organisasi, dokumen identitas, dan informasi rekening untuk proses verifikasi akun Event Organizer kamu.
    </p>

    @if ($errors->any())
    <div class="alert alert-error">
        <strong>Periksa kembali data berikut:</strong>
        <ul style="margin: 8px 0 0 20px;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <form
        action="{{ route('eo.kyc.submit') }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="organization_name">Nama EO / Organisasi <span style="color: #EF4444;">*</span></label>
            <input
                type="text"
                id="organization_name"
                name="organization_name"
                value="{{ old('organization_name', $profile->organization_name ?? '') }}"
                placeholder="Masukkan nama EO / organisasi kamu"
                maxlength="255"
                required>
        </div>

        <div class="form-group">
            <label for="ktp_number">Nomor Induk Kependudukan (NIK/KTP) <span style="color: #EF4444;">*</span></label>
            <input
                type="text"
                id="ktp_number"
                name="ktp_number"
                value="{{ old('ktp_number', $profile->ktp_number ?? '') }}"
                placeholder="16 digit nomor KTP"
                maxlength="255"
                required>
        </div>

        <div class="form-group">
            <label for="ktp_image">Foto / Scan KTP Penanggung Jawab <span style="color: #EF4444;">*</span></label>
            <input
                type="file"
                id="ktp_image"
                name="ktp_image"
                accept=".jpg,.jpeg,.png"
                required>
            @if(isset($profile->ktp_image))
            <p style="font-size: 12px; color: #166534; margin-top: 4px;">✓ Dokumen KTP sebelumnya sudah tersimpan.</p>
            @endif
            <p class="note">Format: JPG, JPEG, atau PNG. Maksimal 2 MB.</p>
        </div>

        <div class="form-group">
            <label for="npwp_number">Nomor NPWP (Opsional)</label>
            <input
                type="text"
                id="npwp_number"
                name="npwp_number"
                value="{{ old('npwp_number', $profile->npwp_number ?? '') }}"
                placeholder="15 atau 16 digit nomor NPWP jika ada"
                maxlength="255">
        </div>

        <div class="form-group">
            <label for="npwp_image">Foto / Scan NPWP (Opsional)</label>
            <input
                type="file"
                id="npwp_image"
                name="npwp_image"
                accept=".jpg,.jpeg,.png">
            @if(isset($profile->npwp_image))
            <p style="font-size: 12px; color: #166534; margin-top: 4px;">✓ Dokumen NPWP sebelumnya sudah tersimpan.</p>
            @endif
            <p class="note">Format: JPG, JPEG, atau PNG. Maksimal 2 MB.</p>
        </div>

        <div class="form-group">
            <label for="bank_name">Nama Bank Pencairan <span style="color: #EF4444;">*</span></label>
            <input
                type="text"
                id="bank_name"
                name="bank_name"
                value="{{ old('bank_name', $profile->bank_name ?? '') }}"
                placeholder="Contoh: BCA, Mandiri, BRI, BNI"
                maxlength="255"
                required>
        </div>

        <div class="form-group">
            <label for="bank_account_number">Nomor Rekening Bank <span style="color: #EF4444;">*</span></label>
            <input
                type="text"
                id="bank_account_number"
                name="bank_account_number"
                value="{{ old('bank_account_number', $profile->bank_account_number ?? '') }}"
                placeholder="Masukkan nomor rekening yang aktif"
                maxlength="255"
                required>
        </div>

        <div class="form-group">
            <label for="bank_account_holder">Nama Pemilik Rekening <span style="color: #EF4444;">*</span></label>
            <input
                type="text"
                id="bank_account_holder"
                name="bank_account_holder"
                value="{{ old('bank_account_holder', $profile->bank_account_holder ?? '') }}"
                placeholder="Harus sesuai dengan nama buku tabungan"
                maxlength="255"
                required>
        </div>

        <button type="submit">
            Kirim Berkas Pendaftaran
        </button>
    </form>
</div>
@endsection
