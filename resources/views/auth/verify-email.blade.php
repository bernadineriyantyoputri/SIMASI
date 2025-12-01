<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email | SIMASI</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="auth-bg">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card p-4 shadow rounded-4 auth-card">

        <div class="text-center mb-3">
            <img src="{{ asset('images/logo.png') }}" width="55" class="mb-2">
            <h4 class="fw-semibold">Verifikasi Email Anda</h4>
        </div>

        <p class="text-muted">
            Terima kasih telah mendaftar!  
            Sebelum melanjutkan, mohon verifikasi email Anda dengan mengklik link yang telah kami kirimkan.  
            Jika belum menerima email, Anda dapat mengirim ulang link verifikasi.
        </p>

        <!-- SUCCESS MESSAGE -->
        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">
                Link verifikasi baru telah dikirim ke email Anda.
            </div>
        @endif

        <!-- FORM RESEND -->
        <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
            @csrf

            <button class="btn btn-primary w-100 py-2 rounded-pill">
                Kirim Ulang Link Verifikasi
            </button>
        </form>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn-outline-secondary w-100 py-2 rounded-pill">
                Logout
            </button>
        </form>

    </div>

</div>

</body>
</html>
