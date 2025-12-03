@extends('layouts.app')

@section('content')

<div class="pt-2">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Manajemen Pengguna</h1>
    </div>

    <p class="text-gray-600 mb-6">Daftar seluruh pengguna terdaftar dalam sistem.</p>

    <!-- TABLE -->
    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left text-sm">
                    <th class="px-4 py-3 border-b">Foto</th>
                    <th class="px-4 py-3 border-b">Nama</th>
                    <th class="px-4 py-3 border-b">NPM</th>
                    <th class="px-4 py-3 border-b">Email</th>
                    <th class="px-4 py-3 border-b">Role</th>
                    <th class="px-4 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr class="text-sm hover:bg-gray-50">

                    <!-- FOTO -->
                    <td class="px-4 py-3 border-b">
                        <img src="{{ $user->photo ? asset('storage/' . $user->photo) 
                            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                             class="w-10 h-10 rounded-full object-cover">
                    </td>

                    <!-- NAMA -->
                    <td class="px-4 py-3 border-b font-medium">{{ $user->name }}</td>

                    <!-- NPM -->
                    <td class="px-4 py-3 border-b">{{ $user->npm ?? '-' }}</td>

                    <!-- EMAIL -->
                    <td class="px-4 py-3 border-b">{{ $user->email }}</td>

                    <!-- ROLE -->
                    <td class="px-4 py-3 border-b">
                        <span class="px-2 py-1 text-xs rounded 
                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>

                    <!-- ACTIONS -->
                    <td class="px-4 py-3 border-b text-center">

                        <div class="flex justify-center gap-2">

                            <!-- HAPUS -->
                            <form action="{{ route('admin.pengguna.destroy', $user->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus pengguna ini? Semua data terkait juga akan terhapus!')">
                                @csrf
                                @method('DELETE')

                                <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs">
                                    Hapus
                                </button>
                            </form>
                        </div>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

@endsection
