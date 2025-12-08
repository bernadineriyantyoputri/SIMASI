@extends('layouts.app')

@section('content')

<div class="p-6 bg-white rounded-xl shadow">

    {{-- pesan berhasil update --}}
    @if (session('status') === 'profile-updated')
        <div class="p-3 mb-4 bg-green-100 text-green-700 rounded">
            Profil berhasil diperbarui.
        </div>
    @endif

    <h2 class="text-2xl font-bold mb-6">Profil Saya</h2>

    <div class="flex flex-col md:flex-row gap-6">

        {{-- FOTO PROFIL --}}
        <div class="flex flex-col items-center md:items-start gap-3">
            @if ($user->photo)
                <img src="{{ asset('storage/'.$user->photo) }}"
                     class="w-24 h-24 rounded-full object-cover border">
            @else
                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-xl font-semibold text-gray-600">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
            @endif

            <div class="text-sm text-gray-600 text-center md:text-left">
                <div class="font-semibold text-gray-800">{{ $user->name }}</div>
                <div>{{ $user->email }}</div>
                <div>NPM: {{ $user->npm ?? '-' }}</div>
            </div>
        </div>

        {{-- DATA PROFIL --}}
        <div class="flex-1 space-y-4">

            <div>
                <div class="text-sm text-gray-500 mb-1">Nama</div>
                <div class="border rounded-lg px-3 py-2 bg-gray-50">{{ $user->name }}</div>
            </div>

            <div>
                <div class="text-sm text-gray-500 mb-1">Email</div>
                <div class="border rounded-lg px-3 py-2 bg-gray-50">{{ $user->email }}</div>
            </div>

            <div>
                <div class="text-sm text-gray-500 mb-1">NPM</div>
                <div class="border rounded-lg px-3 py-2 bg-gray-50">{{ $user->npm ?? '-' }}</div>
            </div>

        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <a href="{{ route('profile.edit') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Edit Profil
        </a>
    </div>

</div>

@endsection
