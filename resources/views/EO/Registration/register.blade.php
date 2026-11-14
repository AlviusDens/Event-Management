<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar sebagai EO — M!VENT</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Instrument Sans', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: #F8FAFC;
            color: #0F172A;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        nav {
            height: 70px;
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 48px;
            border-bottom: 1px solid #E2E8F0;
        }

        .logo {
            font-size: 24px;
            font-weight: 800;
            color: #0F172A;
            letter-spacing: -0.5px;
            text-decoration: none;
        }

        .logo span {
            color: #38BDF8;
        }

        .nav-back {
            color: #64748B;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .nav-back:hover {
            color: #0F172A;
        }

        .auth-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .container {
            width: 480px;
            max-width: 100%;
            background: #FFFFFF;
            padding: 40px 36px;
            border-radius: 16px;
            box-shadow: 0 4px 25px rgba(15, 23, 42, 0.08);
            border: 1px solid #E2E8F0;
        }

        h1 {
            font-size: 26px;
            font-weight: 800;
            color: #0F172A;
            margin-bottom: 6px;
            text-align: center;
        }

        .subtitle {
            text-align: center;
            color: #64748B;
            font-size: 14px;
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 14px;
            color: #334155;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid #CBD5E1;
            border-radius: 8px;
            font-size: 14px;
            color: #0F172A;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
        }

        input:focus {
            border-color: #38BDF8;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
        }

        .error {
            color: #DC2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            background: #FEF2F2;
            color: #991B1B;
            border: 1px solid #FECACA;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background-color: #38BDF8;
            color: #0C4A6E;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s ease;
            font-family: inherit;
            margin-top: 8px;
        }

        button:hover {
            background-color: #0EA5E9;
        }

        .login-link {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #64748B;
        }

        .login-link a {
            color: #0284C7;
            font-weight: 700;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <nav>
        <a href="{{ route('home') }}" class="logo">
            M<span>!</span>VENT
        </a>
        <a href="{{ route('home') }}" class="nav-back">
            &larr; Kembali ke Beranda
        </a>
    </nav>

    <div class="auth-wrapper">
        <div class="container">
            <h1>Daftar sebagai EO</h1>
            <p class="subtitle">
                Bergabunglah sebagai Event Organizer dan mulai kelola event kamu di M!VENT.
            </p>

            @if ($errors->any())
                <div class="alert">
                    <strong>Periksa kembali data pendaftaran:</strong>
                    <ul style="margin: 8px 0 0 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert">{{ session('error') }}</div>
            @endif

            <form action="{{ route('eo.register.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama Lengkap / Nama EO</label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Contoh: Budi Organizer"
                        maxlength="255"
                        required
                        autofocus
                    >
                    @error('nama')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@organizer.com"
                        maxlength="255"
                        required
                    >
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Minimal 8 karakter"
                        minlength="8"
                        required
                    >
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit">
                    Daftar Sekarang
                </button>
            </form>

            <div class="login-link">
                Sudah memiliki akun EO?
                <a href="{{ route('eo.login') }}">
                    Masuk di sini
                </a>
            </div>
        </div>
    </div>

</body>
</html>
