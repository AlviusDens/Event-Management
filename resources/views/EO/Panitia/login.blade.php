<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panitia - M!VENT</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        :root {
            --bg-color: #F8FAFC;
            --primary: #38BDF8;
            --primary-dark: #0EA5E9;
            --text-dark: #0F172A;
            --text-muted: #64748B;
            --border-color: #E2E8F0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Instrument Sans', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
        }

        .login-card {
            background: #FFFFFF;
            border-radius: 20px;
            border: 1px solid var(--border-color);
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.08);
            width: 100%;
            max-width: 420px;
            padding: 36px 32px;
        }

        .brand-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .brand-logo {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.02em;
            display: inline-block;
            margin-bottom: 6px;
        }

        .brand-logo span {
            color: var(--primary-dark);
        }

        .portal-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
            background: #E0F2FE;
            color: #0369A1;
            margin-bottom: 8px;
        }

        .title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .subtitle {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .alert-error {
            background-color: #FEE2E2;
            color: #991B1B;
            border: 1px solid #FCA5A5;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 14px;
            background-color: #FFFFFF;
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.25);
        }

        .btn-submit {
            width: 100%;
            padding: 13px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            background-color: var(--primary);
            color: #0C4A6E;
            transition: all 0.2s ease;
            margin-top: 8px;
        }

        .btn-submit:hover {
            background-color: var(--primary-dark);
            color: #FFFFFF;
            transform: translateY(-1px);
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
        }

        .back-link a {
            color: var(--text-muted);
            text-decoration: none;
        }

        .back-link a:hover {
            color: var(--text-dark);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="brand-header">
            <a href="{{ route('home') }}" style="text-decoration: none;">
                <div class="brand-logo">M<span>!</span>VENT</div>
            </a>
            <div>
                <span class="portal-badge">Portal Panitia Event</span>
            </div>
            <h1 class="title">Masuk ke Panel Panitia</h1>
            <p class="subtitle">Gunakan akun yang telah didaftarkan oleh penyelenggara event.</p>
        </div>

        @if (session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('panitia.login.authenticate') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Panitia</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama akun Anda" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
            </div>

            <button type="submit" class="btn-submit">
                Masuk ke Panel Panitia
            </button>
        </form>

        <div class="back-link">
            <a href="{{ route('home') }}">← Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>
