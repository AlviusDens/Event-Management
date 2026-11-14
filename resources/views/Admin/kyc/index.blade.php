@extends('layouts.admin')
@section('title', 'Pemeriksaan KYC EO — M!VENT Admin')
@section('content')

    <div class="header">
        <h1>Pemeriksaan Dokumen KYC EO</h1>
        <p>Verifikasi legalitas profil, identitas penanggung jawab, dan rekening Event Organizer.</p>
    </div>

    <div class="card" style="padding: 20px 24px;">
        <form method="GET" action="{{ route('admin.kyc.index') }}" style="display: flex; gap: 14px; align-items: flex-end; flex-wrap: wrap;">
            <div class="field" style="margin-bottom: 0; min-width: 220px; flex: 1;">
                <label>Filter Status Verifikasi</label>
                <select name="status">
                    <option value="">Semua Status</option>
                    <option value="pending" @selected(($status ?? '') === 'pending')>⏳ Menunggu Verifikasi</option>
                    <option value="verified" @selected(($status ?? '') === 'verified')>✓ Terverifikasi</option>
                    <option value="rejected" @selected(($status ?? '') === 'rejected')>✕ Ditolak</option>
                </select>
            </div>

            <div style="display: flex; gap: 8px;">
                <button class="btn btn-primary" type="submit">Terapkan Filter</button>
                <a href="{{ route('admin.kyc.index') }}" class="btn btn-gray">Reset</a>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nama Organisasi</th>
                        <th>Penanggung Jawab</th>
                        <th>Email</th>
                        <th>Status KYC</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($profiles as $profile)
                        <tr>
                            <td style="font-weight: 600; color: #0F172A;">{{ $profile->organization_name }}</td>
                            <td>{{ $profile->user_name }}</td>
                            <td>{{ $profile->user_email }}</td>
                            <td>
                                <span class="badge {{ $profile->verification_status }}">
                                    {{ strtoupper($profile->verification_status) }}
                                </span>
                            </td>
                            <td>
                                <a class="btn btn-dark" style="font-size: 13px; padding: 7px 14px;" href="{{ route('admin.kyc.show', $profile->id) }}">
                                    Periksa Dokumen →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 36px; color: #94A3B8;">
                                Belum ada profil KYC yang sesuai dengan filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
