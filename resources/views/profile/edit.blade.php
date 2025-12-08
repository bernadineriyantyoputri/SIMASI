@extends('layouts.app')

@section('content')

<div class="p-6 bg-white rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-6">Edit Profil</h2>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label class="block text-sm mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block text-sm mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block text-sm mb-1">NPM</label>
            <input type="text" name="npm" value="{{ old('npm', $user->npm) }}"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block text-sm mb-1">Foto Profil</label>
            <input type="file" name="photo" class="w-full">
        </div>

        @if ($user->photo)
            <div class="mb-4">
                <img src="{{ asset('storage/'.$user->photo) }}"
                     class="w-20 h-20 rounded-full border object-cover">
            </div>
        @endif

        <div class="mt-6 flex justify-end gap-2">
            <a href="{{ route('profile.show') }}"
                class="px-4 py-2 bg-gray-300 text-black rounded-lg hover:bg-gray-400">Kembali</a>

            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </div>

    </form>

</div>

@endsection
