@extends('layouts.app')

@section('content')

<div class="p-6 bg-white rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-6">Profil Saya</h2>

    {{-- Flash message --}}
    @if (session('status') === 'profile-updated')
        <div class="p-3 mb-4 bg-green-100 text-green-700 rounded">
            Profil berhasil diperbarui.
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" 
          enctype="multipart/form-data" 
          class="space-y-4">
        @csrf
        @method('PATCH')

        {{-- Nama --}}
        <div>
            <label class="block font-semibold mb-1">Nama</label>
            <input type="text" name="name"
                   value="{{ old('name', $user->name) }}"
                   class="w-full border px-3 py-2 rounded-lg" required>
        </div>

        {{-- Email --}}
        <div>
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" name="email"
                   value="{{ old('email', $user->email) }}"
                   class="w-full border px-3 py-2 rounded-lg" required>
        </div>

        {{-- NPM --}}
        <div>
            <label class="block font-semibold mb-1">NPM</label>
            <input type="text" name="npm"
                   value="{{ old('npm', $user->npm) }}"
                   class="w-full border px-3 py-2 rounded-lg">
            @error('npm')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Foto Profil --}}
        <div>
            <label class="block font-semibold mb-1">Foto Profil</label>

            <input type="file" name="photo"
                   class="w-full border px-3 py-2 rounded-lg">

            @if ($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}"
                     class="w-20 h-20 rounded-full mt-2 object-cover border">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
                     class="w-20 h-20 rounded-full mt-2 object-cover border">
            @endif
        </div>

        {{-- Tombol --}}
        <div class="flex items-center gap-3 mt-4">
            <a href="{{ route('user.kegiatan.index') }}"
               class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">
                Kembali
            </a>

            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                Simpan Perubahan
            </button>
        </div>

    </form>

</div>

@endsection
