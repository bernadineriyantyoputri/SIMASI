@extends('layouts.app')

@section('content')

<div class="p-6 bg-white rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-6">Edit Profil</h2>

    <form method="POST" action="{{ route('profile.update') }}" 
          enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')

        {{-- NAMA --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Nama
            </label>
            <input type="text" name="name"
                   class="w-full border rounded-lg px-3 py-2"
                   value="{{ old('name', $user->name) }}">
            @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Email
            </label>
            <input type="email" name="email"
                   class="w-full border rounded-lg px-3 py-2"
                   value="{{ old('email', $user->email) }}">
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- NPM --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                NPM
            </label>
            <input type="text" name="npm"
                   class="w-full border rounded-lg px-3 py-2"
                   value="{{ old('npm', $user->npm) }}">
            @error('npm')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- FOTO PROFIL --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Foto Profil
            </label>
            <input type="file" name="photo"
                   class="w-full border rounded-lg px-3 py-2 bg-white">
            @error('photo')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror

            @if ($user->photo)
                <div class="mt-3">
                    <p class="text-xs text-gray-500 mb-1">Foto saat ini:</p>
                    <img src="{{ asset('storage/'.$user->photo) }}"
                         class="w-20 h-20 rounded-full object-cover border">
                </div>
            @endif
        </div>

        {{-- TOMBOL --}}
        <div class="flex items-center justify-between pt-4 border-t">
            <a href="{{ route('profile.show') }}"
               class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">
                Kembali
            </a>

            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </div>

    </form>

</div>

@endsection
