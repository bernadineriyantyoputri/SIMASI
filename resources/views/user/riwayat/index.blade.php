@extends('layouts.app')

@section('content')

<div class="px-4 md:px-8 py-6">

    <h1 class="text-2xl font-bold mb-2">Riwayat Kehadiran</h1>
    <p class="text-gray-600 mb-6">Lihat semua riwayat kehadiran kamu</p>

    <div class="bg-blue-100 p-4 rounded-lg mb-8 w-60 text-left">
        <p class="font-semibold">Total Kehadiran</p>
        <p class="text-lg">{{ $riwayat->count() }} Acara</p>
    </div>

    @if ($riwayat->isEmpty())
        <div class="p-6 bg-white shadow rounded-lg text-center text-gray-500">
            Belum ada riwayat kehadiran.
        </div>
    @endif

    @foreach ($riwayat as $item)
        <div class="bg-white p-6 shadow rounded-lg mb-4">

            <p class="text-sm text-gray-600 mb-2">Nama Acara</p>
            <p class="font-semibold text-lg mb-4">
                {{ $item->kegiatan->judul ?? '-' }}
            </p>

            <div class="grid grid-cols-3 gap-4 text-sm">

                <div>
                    <p class="text-gray-500">Tanggal Acara</p>
                    <p class="font-medium">
                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('D, d M Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Waktu Check In</p>
                    <p class="font-medium">
                        {{ \Carbon\Carbon::parse($item->jam_hadir)->format('H:i') }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Metode</p>
                    <p class="font-medium">Manual</p>
                </div>

            </div>

        </div>
    @endforeach

</div>

@endsection
