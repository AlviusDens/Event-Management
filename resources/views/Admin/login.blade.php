<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator — M!VENT</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Instrument Sans', system-ui, -apple-system, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #F8FAFC;
            color: #0F172A;
            padding: 20px;
        }

        .login-container {
            width: 420px;
            max-width: 100%;
            background: #FFFFFF;
            padding: 40px 36px;
            border-radius: 16px;
            box-shadow: 0 4px 25px rgba(15, 23, 42, 0.08);
            border: 1px solid #E2E8F0;
        }

        .logo {
            text-align: center;
            font-size: 28px;
            font-weight: 800;
            color: #0F172A;
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }

        .logo span {
            color: #38BDF8;
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
            font-size: 14px;
            font-weight: 600;
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

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #38BDF8;
            color: #0C4A6E;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 700;
            transition: background 0.2s ease;
            font-family: inherit;
            margin-top: 8px;
        }

        .btn-login:hover {
            background: #0EA5E9;
        }

        .error {
            background: #FEF2F2;
            color: #991B1B;
            border: 1px solid #FECACA;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .success {
            background: #F0FDF4;
            color: #166534;
            border: 1px solid #BBF7D0;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .back-home {
            text-align: center;
            margin-top: 24px;
            font-size: 13px;
        }

        .back-home a {
            color: #64748B;
            text-decoration: none;
        }

        .back-home a:hover {
            color: #0F172A;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="logo">
            M<span>!</span>VENT
        </div>

        <div class="subtitle">
            Portal Administrator Platform
        </div>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.authenticate') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" placeholder="admin@mevent.com" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">
                Masuk ke Admin Portal
            </button>
        </form>

        <div class="back-home">
            <a href="{{ route('home') }}">&larr; Kembali ke Beranda Publik</a>
        </div>
    </div>

</body>
</html>
