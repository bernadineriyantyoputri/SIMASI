@extends('layouts.app')

@section('content')
<div class="pt-2 max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-bold">Manajemen Pengguna</h1>
            <p class="text-gray-600 text-sm">Daftar seluruh pengguna terdaftar dalam sistem.</p>
        </div>

        <a href="{{ route('admin.pengguna.create') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
            + Tambah Pengguna
        </a>
    </div>

    {{-- FLASH MESSAGE --}}
    @if (session('success'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-800 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 text-red-800 text-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- TABLE WRAPPER --}}
    <div class="bg-white shadow rounded-xl overflow-hidden border border-gray-200">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left text-xs md:text-sm">
                    <th class="px-4 py-3 border-b">Foto</th>
                    <th class="px-4 py-3 border-b">Nama</th>
                    <th class="px-4 py-3 border-b">NPM</th>
                    <th class="px-4 py-3 border-b">Email</th>
                    <th class="px-4 py-3 border-b">Role</th>
                    <th class="px-4 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr class="text-xs md:text-sm hover:bg-gray-50">

                        {{-- FOTO --}}
                        <td class="px-4 py-3 border-b">
                            <img
                                src="{{ $user->photo
                                    ? asset('storage/' . $user->photo)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                                class="w-10 h-10 rounded-full object-cover"
                                alt="Foto {{ $user->name }}">
                        </td>

                        {{-- NAMA --}}
                        <td class="px-4 py-3 border-b font-medium">
                            {{ $user->name }}
                        </td>

                        {{-- NPM --}}
                        <td class="px-4 py-3 border-b">
                            {{ $user->npm ?? '-' }}
                        </td>

                        {{-- EMAIL --}}
                        <td class="px-4 py-3 border-b">
                            {{ $user->email }}
                        </td>

                        {{-- ROLE --}}
                        <td class="px-4 py-3 border-b">
                            <span class="px-2 py-1 text-xs rounded
                                {{ $user->role === 'admin'
                                    ? 'bg-red-100 text-red-600'
                                    : 'bg-blue-100 text-blue-600' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        {{-- ACTIONS --}}
                        <td class="px-4 py-3 border-b">
                            <div class="flex justify-center gap-2">

                                {{-- EDIT --}}
                                <a href="{{ route('admin.pengguna.edit', $user->id) }}"
                                   class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-xs">
                                    Edit
                                </a>

                                {{-- HAPUS --}}
                                <form action="{{ route('admin.pengguna.destroy', $user->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus pengguna ini? Semua data terkait juga akan terhapus!')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500 text-sm">
                            Belum ada pengguna terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
