{{-- resources/views/admin/profile/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Profil Admin</h1>

    <div class="flex flex-col md:flex-row gap-6">

        {{-- FOTO + IDENTITAS SINGKAT --}}
        <div class="flex flex-col items-center md:items-start gap-3 w-full md:w-1/3">
            @if ($admin->photo)
                <img src="{{ asset('storage/' . $admin->photo) }}"
                     alt="Foto Profil"
                     class="w-24 h-24 rounded-full object-cover border">
            @else
                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-xl font-semibold text-gray-600">
                    {{ strtoupper(substr($admin->name, 0, 2)) }}
                </div>
            @endif

            <div class="text-sm text-gray-700 text-center md:text-left">
                <div class="font-semibold text-gray-900">{{ $admin->name }}</div>
                <div class="text-gray-600">{{ $admin->email }}</div>
                @if ($admin->npm)
                    <div class="text-gray-600">NPM: {{ $admin->npm }}</div>
                @endif
            </div>
        </div>

        {{-- DETAIL PROFIL --}}
        <div class="flex-1 space-y-4">

            {{-- Nama --}}
            <div>
                <label class="text-sm text-gray-500 mb-1 block">Nama</label>
                <div class="border rounded-lg px-3 py-2 bg-gray-50 text-gray-800">
                    {{ $admin->name }}
                </div>
            </div>

            {{-- Email --}}
            <div>
                <label class="text-sm text-gray-500 mb-1 block">Email</label>
                <div class="border rounded-lg px-3 py-2 bg-gray-50 text-gray-800">
                    {{ $admin->email }}
                </div>
            </div>

            {{-- NPM --}}
            <div>
                <label class="text-sm text-gray-500 mb-1 block">NPM</label>
                <div class="border rounded-lg px-3 py-2 bg-gray-50 text-gray-800">
                    {{ $admin->npm ?? '-' }}
                </div>
            </div>

        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <a href="{{ route('admin.profile.edit') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Edit Profil
        </a>
    </div>
</div>
@endsection
