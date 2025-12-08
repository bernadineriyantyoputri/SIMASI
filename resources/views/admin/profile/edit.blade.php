@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-6">Edit Profil Admin</h2>

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="space-y-4">

            <div>
                <label class="block text-sm mb-1 text-gray-600">Nama</label>
                <input type="text" name="name" value="{{ old('name', $admin->name) }}"
                       class="w-full border px-3 py-2 rounded">
                @error('name')
                    <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm mb-1 text-gray-600">Email</label>
                <input type="email" name="email" value="{{ old('email', $admin->email) }}"
                       class="w-full border px-3 py-2 rounded">
                @error('email')
                    <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm mb-1 text-gray-600">NPM</label>
                <input type="text" name="npm" value="{{ old('npm', $admin->npm) }}"
                       class="w-full border px-3 py-2 rounded">
                @error('npm')
                    <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm mb-1 text-gray-600">Foto Profil</label>
                <input type="file" name="photo" class="w-full">
                @if ($admin->photo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$admin->photo) }}"
                             class="w-16 h-16 rounded-full border object-cover">
                    </div>
                @endif
                @error('photo')
                    <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm mb-1 text-gray-600">
                    Password Baru (opsional)
                </label>
                <input type="password" name="password"
                       class="w-full border px-3 py-2 rounded">
                @error('password')
                    <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-2">
            <a href="{{ route('admin.profile') }}"
               class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                Batal
            </a>
            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </div>

    </form>

</div>

@endsection
