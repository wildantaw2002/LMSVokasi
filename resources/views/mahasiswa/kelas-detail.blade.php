@extends('layout.app')
@section('title', $kelas->nama_kelas)
@section('content')

<div class="container mx-auto px-4 py-8">
    <a href="{{ route('kelas.index') }}" class="text-blue-500 hover:text-blue-700 mb-4">← Kembali</a>

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h1 class="text-3xl font-bold mb-2">{{ $kelas->nama_kelas }}</h1>
        <p class="text-gray-600 mb-4">Kode: {{ $kelas->kode_kelas }}</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-blue-50 p-4 rounded">
                <p class="text-gray-600">Instruktur</p>
                <p class="text-lg font-semibold">{{ $kelas->instruktur->name }}</p>
            </div>
            <div class="bg-green-50 p-4 rounded">
                <p class="text-gray-600">Jumlah Mahasiswa</p>
                <p class="text-lg font-semibold">{{ $kelas->mahasiswas->count() }} orang</p>
            </div>
        </div>

        @if($kelas->deskripsi)
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
                <p class="text-gray-700">{{ $kelas->deskripsi }}</p>
            </div>
        @endif
    </div>

    <!-- Jadwal -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-2xl font-semibold mb-4">Jadwal Kelas</h2>
        @if($kelas->jadwals->isEmpty())
            <p class="text-gray-500">Belum ada jadwal</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-4 py-2 text-left">Hari</th>
                            <th class="px-4 py-2 text-left">Jam Mulai</th>
                            <th class="px-4 py-2 text-left">Jam Selesai</th>
                            <th class="px-4 py-2 text-left">Ruangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kelas->jadwals as $jadwal)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $jadwal->hari }}</td>
                                <td class="px-4 py-2">{{ $jadwal->jam_mulai->format('H:i') }}</td>
                                <td class="px-4 py-2">{{ $jadwal->jam_selesai->format('H:i') }}</td>
                                <td class="px-4 py-2">{{ $jadwal->ruangan ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Tugas -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold mb-4">Tugas Kelas</h2>
        @if($kelas->tugas->isEmpty())
            <p class="text-gray-500">Belum ada tugas</p>
        @else
            <div class="space-y-3">
                @foreach($kelas->tugas as $tugas)
                    <div class="bg-gray-50 p-4 rounded border-l-4 border-blue-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold">{{ $tugas->judul_tugas }}</h3>
                                <p class="text-sm text-gray-600">{{ Str::limit($tugas->deskripsi, 100) }}</p>
                            </div>
                            <p class="text-red-600 font-semibold whitespace-nowrap">
                                {{ $tugas->tanggal_deadline->format('d/m/Y') }}
                            </p>
                        </div>
                        <a href="{{ route('tugas.show', $tugas->id) }}" class="text-blue-500 hover:text-blue-700 text-sm mt-2">
                            Lihat Detail →
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection
