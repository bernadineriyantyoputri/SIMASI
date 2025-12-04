@extends('layouts.app') {{-- atau layout user kamu yang biasa --}}

@section('content')
    <div class="pt-4 pb-20 max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Absensi Kegiatan</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @forelse ($kegiatan as $k)
            @php
                $absen = $absensiUser[$k->id] ?? null;
            @endphp

            <div class="bg-white border rounded-xl p-4 mb-4 shadow-sm">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h2 class="font-semibold text-lg">{{ $k->judul }}</h2>
                        <p class="text-sm text-gray-600">
                            Tanggal kegiatan: {{ \Carbon\Carbon::parse($k->tanggal)->format('d-m-Y') }}
                        </p>
                    </div>

                    {{-- BADGE STATUS --}}
                    @if ($absen)
                        <span class="px-3 py-1 rounded-full text-xs
                            @if ($absen->approval_status === 'approved') bg-green-100 text-green-800
                            @elseif ($absen->approval_status === 'rejected') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                            Status: {{ ucfirst($absen->approval_status) }}
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full text-xs bg-gray-100 text-gray-600">
                            Belum absen
                        </span>
                    @endif
                </div>

                {{-- LOGIKA TAMPILAN BERDASARKAN STATUS --}}
                @if (! $absen)
                    {{-- BELUM PERNAH ABSEN → BOLEH ISI FORM --}}
                    @include('user.absensi._form', ['kegiatan' => $k])
                @elseif ($absen->approval_status === 'rejected')
                    {{-- DITOLAK → BOLEH ABSEN ULANG --}}
                    <p class="text-sm text-red-600 mb-3">
                        Absensi kamu sebelumnya <strong>ditolak</strong>. Silakan kirim ulang absensi dengan bukti foto yang valid.
                    </p>

                    @include('user.absensi._form', ['kegiatan' => $k])
                @elseif ($absen->approval_status === 'pending')
                    {{-- PENDING → TIDAK BOLEH KIRIM LAGI --}}
                    <p class="text-sm text-yellow-700">
                        Absensi kamu sudah dikirim dan sedang menunggu persetujuan admin.
                    </p>
                @elseif ($absen->approval_status === 'approved')
                    {{-- APPROVED → TIDAK BOLEH KIRIM LAGI --}}
                    <p class="text-sm text-green-700">
                        Absensi kamu sudah disetujui admin. Terima kasih 🙌
                    </p>
                @endif
            </div>
        @empty
            <p class="text-sm text-gray-600">
                Belum ada kegiatan yang bisa kamu absen, atau kamu belum disetujui sebagai peserta.
            </p>
        @endforelse
    </div>
@endsection
