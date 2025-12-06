@extends('layouts.app')

@section('content')

<div class="px-4 md:px-8 py-6">

    <h1 class="text-2xl font-bold mb-1">Absensi Kegiatan</h1>
    <p class="text-gray-600 mb-6">Silakan isi absensi untuk kegiatan yang kamu ikuti</p>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg mb-4 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded-lg mb-4 border border-red-200">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6">

        @forelse ($kegiatan as $k)
            @php
                $absen = $absensiUser[$k->id] ?? null;
            @endphp

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4">

                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h2 class="text-sm font-semibold text-gray-800">
                            {{ $k->judul }}
                        </h2>

                        <div class="mt-1 text-[12px] text-gray-600">
                            <div class="flex gap-1 items-center">
                                <i class="fa-regular fa-calendar text-[10px]"></i>
                                {{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('l, d F Y') }}
                            </div>
                        </div>
                    </div>

                    <span class="
                        px-3 py-1 rounded-full text-[11px] font-medium
                        @if ($absen && $absen->approval_status === 'approved')
                            bg-green-100 text-green-700 border border-green-200
                        @elseif ($absen && $absen->approval_status === 'rejected')
                            bg-red-100 text-red-700 border border-red-200
                        @elseif ($absen && $absen->approval_status === 'pending')
                            bg-yellow-100 text-yellow-700 border border-yellow-200
                        @else
                            bg-gray-100 text-gray-600 border border-gray-200
                        @endif
                    ">
                        {{ $absen ? ucfirst($absen->approval_status) : 'Belum Absen' }}
                    </span>
                </div>

                @if (! $absen)

                    @include('user.absensi._form', ['kegiatan' => $k])

                @elseif ($absen->approval_status === 'rejected')

                    <p class="text-sm text-red-600 mb-3">
                        Absensi sebelumnya <strong>ditolak</strong>. Silakan kirim ulang.
                    </p>

                    @include('user.absensi._form', ['kegiatan' => $k])

                @elseif ($absen->approval_status === 'pending')

                    <p class="text-sm text-yellow-700">
                        Absensi kamu sedang <strong>menunggu persetujuan</strong> admin.
                    </p>

                @elseif ($absen->approval_status === 'approved')

                    <p class="text-sm text-green-700">
                        Absensi kamu <strong>sudah disetujui</strong>. Terima kasih!
                    </p>

                @endif

            </div>
        @empty

            <p class="text-gray-600 text-sm">
                Tidak ada kegiatan yang dapat kamu absen saat ini.
            </p>

        @endforelse

    </div>

</div>

@endsection
