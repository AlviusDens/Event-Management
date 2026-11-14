<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login EO — M!VENT</title>

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
            display: inline-flex;
            align-items: center;
            gap: 6px;
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
            width: 440px;
            max-width: 100%;
            background-color: #FFFFFF;
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
            font-weight: 600;
            font-size: 14px;
            color: #334155;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid #CBD5E1;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            color: #0F172A;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
        }

        input:focus {
            border-color: #38BDF8;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
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

        .error {
            margin-bottom: 20px;
            padding: 12px 16px;
            background-color: #FEF2F2;
            color: #991B1B;
            border: 1px solid #FECACA;
            border-radius: 8px;
            font-size: 14px;
        }

        .register {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #64748B;
        }

        .register a {
            color: #0284C7;
            font-weight: 700;
            text-decoration: none;
        }

        .register a:hover {
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
            <h1>Login Penyelenggara</h1>
            <p class="subtitle">
                Masuk untuk mengelola event dan tiket kamu.
            </p>

            @if (session('error'))
                <div class="error">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div style="background: #F0FDF4; color: #166534; border: 1px solid #BBF7D0; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('eo.login.authenticate') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="nama@organizer.com"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        required
                    >
                </div>

                <button type="submit">
                    Masuk ke Dashboard EO
                </button>
            </form>

            <div class="register">
                Belum memiliki akun EO?
                <a href="{{ route('eo.register') }}">
                    Daftar sebagai EO
                </a>
            </div>
        </div>
    </div>

</body>
</html>
