<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi OTP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Kalau kamu punya CSS sendiri, boleh pakai --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .card {
            background: #ffffff;
            padding: 2rem 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);
            width: 100%;
            max-width: 420px;
        }
        h1 {
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
        }
        p {
            margin-top: 0;
            margin-bottom: 1.5rem;
            color: #4b5563;
            font-size: 0.95rem;
        }
        label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }
        input[type="text"] {
            width: 100%;
            padding: 0.7rem 0.9rem;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            font-size: 1rem;
        }
        input[type="text"]:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 1px #2563eb33;
        }
        .btn-primary {
            width: 100%;
            margin-top: 1rem;
            padding: 0.75rem;
            border-radius: 0.5rem;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            background: #2563eb;
            color: white;
            cursor: pointer;
        }
        .btn-primary:hover {
            background: #1d4ed8;
        }
        .error {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            border-radius: 0.5rem;
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
            margin-bottom: 0.75rem;
        }
        .info-email {
            background: #eff6ff;
            border-radius: 0.5rem;
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
            color: #1d4ed8;
            margin-bottom: 0.75rem;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Verifikasi Kode OTP</h1>
        <p>
            Kami telah mengirimkan kode OTP ke email berikut.
            Masukkan kode tersebut untuk mengaktifkan akun kamu.
        </p>

        <div class="info-email">
            Email: <strong>{{ $email }}</strong>
        </div>

        {{-- TAMPILKAN ERROR JIKA ADA --}}
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="error">{{ $error }}</div>
            @endforeach
        @endif

        <form method="POST" action="{{ route('otp.verify') }}">
            {{-- INI YANG WAJIB: TOKEN CSRF --}}
            @csrf

            {{-- Email dikirim sebagai hidden agar cocok dengan OTP yang disimpan --}}
            <input type="hidden" name="email" value="{{ $email }}">

            <div style="margin-bottom: 1rem;">
                <label for="otp">Kode OTP</label>
                <input
                    id="otp"
                    type="text"
                    name="otp"
                    placeholder="Masukkan 6 digit kode"
                    maxlength="6"
                    required
                >
            </div>

            <button type="submit" class="btn-primary">
                Verifikasi
            </button>
        </form>
    </div>
</body>
</html>
