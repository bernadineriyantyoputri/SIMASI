<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password | SIMASI</title>

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
            <h4 class="fw-semibold">Reset Password</h4>
            <p class="text-muted">Masukkan email untuk menerima link reset password.</p>
        </div>

        <!-- SUCCESS MESSAGE -->
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <input type="email" name="email" 
                       class="form-control" placeholder="Masukkan Email"
                       value="{{ old('email') }}" required autofocus>
                
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-primary w-100 py-2 rounded-pill">
                Kirim Link Reset Password
            </button>

            <p class="text-center mt-3">
                <a href="{{ route('login') }}">Kembali ke Login</a>
            </p>
        </form>

    </div>

</div>

</body>
</html>
