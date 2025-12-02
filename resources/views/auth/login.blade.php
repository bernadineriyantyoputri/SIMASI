@extends('layouts.guest')

@section('content')
<div class="container-fluid">
    <div class="row vh-100">

        <!-- KIRI -->
        <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-start text-white p-5 left-clean">
            <h1 class="fw-bold display-3">Dare to<br>change!</h1>
        </div>

        <!-- KANAN: FORM LOGIN -->
        <div class="col-md-6 d-flex justify-content-center align-items-center">

            <div class="card shadow p-4 rounded-4"
                 style="width: 90%; max-width: 420px; border: none; background: rgba(255,255,255,0.92); backdrop-filter: blur(5px);">

                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo.png') }}" width="60" class="mb-2">
                    <h4 class="fw-semibold">Selamat Datang Kembali</h4>
                </div>

                <!-- ERROR LOGIN -->
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- FORM LOGIN -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <input type="text" name="email" class="form-control" placeholder="Email"
                               value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember">
                            <label class="form-check-label">Remember me</label>
                        </div>

                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Lupa Kata Sandi?</a>
                        @endif
                    </div>

                    <button class="btn btn-primary w-100 py-2 rounded-pill">Login</button>

                    <p class="text-center mt-3">
                        Belum memiliki akun?
                        <a href="{{ route('register') }}">Daftar disini</a>
                    </p>

                </form>

            </div>

        </div>

    </div>
</div>
@endsection
