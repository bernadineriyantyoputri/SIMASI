<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | SIMASI</title>

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
            <h4 class="fw-semibold">Buat Password Baru</h4>
            <p class="text-muted">Silahkan masukkan password baru Anda.</p>
        </div>

        <!-- FORM RESET PASSWORD -->
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- TOKEN -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- EMAIL -->
            <div class="mb-3">
                <input type="email" name="email" class="form-control"
                       value="{{ old('email', $request->email) }}" required readonly>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- PASSWORD BARU -->
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password baru" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- KONFIRMASI PASSWORD -->
            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control"
                       placeholder="Konfirmasi password" required>
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-primary w-100 py-2 rounded-pill">
                Simpan Password Baru
            </button>

            <p class="text-center mt-3">
                <a href="{{ route('login') }}">Kembali ke Login</a>
            </p>

        </form>

    </div>

</div>

</body>
</html>
