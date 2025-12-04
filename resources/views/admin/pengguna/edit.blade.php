@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-3">Edit Pengguna</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pengguna.update', $pengguna->id) }}" method="POST" enctype="multipart/form-data" class="card p-3 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" id="name" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $pengguna->name) }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $pengguna->email) }}" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="npm" class="form-label">NPM (opsional)</label>
            <input type="text" id="npm" name="npm"
                   class="form-control @error('npm') is-invalid @enderror"
                   value="{{ old('npm', $pengguna->npm) }}">
            @error('npm') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select id="role" name="role"
                    class="form-select @error('role') is-invalid @enderror" required>
                <option value="admin" {{ old('role', $pengguna->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role', $pengguna->role) === 'user' ? 'selected' : '' }}>User</option>
            </select>
            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <hr>

        <div class="mb-3">
            <label class="form-label">Password Baru (opsional)</label>
            <input type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Biarkan kosong jika tidak ingin mengubah password">
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="form-control"
                   placeholder="Ulangi password baru">
        </div>

        <hr>

        <div class="mb-3">
            <label class="form-label">Foto Profil</label>
            @if ($pengguna->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $pengguna->photo) }}" alt="Foto" width="80" class="rounded">
                </div>
            @endif
            <input type="file" name="photo"
                   class="form-control @error('photo') is-invalid @enderror"
                   accept="image/*">
            @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection
