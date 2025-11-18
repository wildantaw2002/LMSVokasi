@extends('layout.app')
@section('title', 'Kelas Saya')
@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Kelas Saya</h1>

    <div class="grid grid-cols-1 gap-6">
        @forelse($kelas as $k)
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-2xl font-bold">{{ $k->nama_kelas }}</h2>
                        <p class="text-gray-600">{{ $k->kode_kelas }}</p>
                    </div>
                    <a href="{{ route('guru.kelas.detail', $k->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                        Detail →
                    </a>
                </div>
                <p class="text-gray-700 mb-4">{{ $k->deskripsi }}</p>
                <p class="text-sm text-gray-500">
                    <strong>Mahasiswa:</strong> {{ $k->mahasiswas()->count() }} orang
                </p>
            </div>
        @empty
            <div class="bg-gray-100 rounded-lg p-8 text-center">
                <p class="text-gray-600 text-lg">Anda belum memiliki kelas</p>
            </div>
        @endforelse
    </div>
</div>

@endsection
