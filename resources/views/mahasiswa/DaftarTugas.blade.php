@extends('layout.app')
@section('title', 'Daftar Tugas')
@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Daftar Tugas</h1>

    <!-- Tugas Belum Selesai -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4 text-orange-600">Tugas Belum Selesai</h2>
        @if($tugasBelumSelesai->isEmpty())
            <p class="text-gray-500">Tidak ada tugas yang belum selesai</p>
        @else
            <div class="space-y-4">
                @foreach($tugasBelumSelesai as $tugas)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-xl font-semibold">{{ $tugas->judul_tugas }}</h3>
                                <p class="text-gray-600">{{ $tugas->kelas->nama_kelas }} ({{ $tugas->kelas->kode_kelas }})</p>
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($tugas->deskripsi, 150) }}</p>
                                <div class="mt-3">
                                    @if($tugas->submissions->first())
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">✓ Sudah Submit</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">✗ Belum Submit</span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right ml-4">
                                <p class="text-red-600 font-semibold">Deadline</p>
                                <p class="text-sm">{{ $tugas->tanggal_deadline->format('d/m/Y') }}</p>
                                <p class="text-sm">{{ $tugas->tanggal_deadline->format('H:i') }}</p>
                                <p class="text-xs text-gray-600 mt-1">
                                    @php
                                        $selisih = $tugas->tanggal_deadline->diffInDays(now(), false);
                                    @endphp
                                    @if($selisih > 0)
                                        {{ $selisih }} hari lagi
                                    @else
                                        Berakhir {{ abs($selisih) }} hari lalu
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('tugas.show', $tugas->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Tugas Selesai -->
    <div>
        <h2 class="text-2xl font-semibold mb-4 text-gray-600">Tugas Selesai</h2>
        @if($tugasSelesai->isEmpty())
            <p class="text-gray-500">Tidak ada tugas selesai</p>
        @else
            <div class="space-y-4">
                @foreach($tugasSelesai as $tugas)
                    <div class="bg-gray-50 rounded-lg shadow-md p-4 opacity-75">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-xl font-semibold">{{ $tugas->judul_tugas }}</h3>
                                <p class="text-gray-600">{{ $tugas->kelas->nama_kelas }}</p>
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($tugas->deskripsi, 150) }}</p>
                            </div>
                            <div class="text-right ml-4">
                                <p class="text-gray-600 font-semibold">Deadline</p>
                                <p class="text-sm">{{ $tugas->tanggal_deadline->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('tugas.show', $tugas->id) }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection
