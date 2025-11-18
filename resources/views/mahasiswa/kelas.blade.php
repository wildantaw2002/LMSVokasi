@extends('layout.app')
@section('title', 'Daftar Kelas')
@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Kelas Saya</h1>

    @if($kelas->isEmpty())
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
            Anda belum terdaftar di kelas manapun.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($kelas as $k)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="bg-blue-500 text-white p-4">
                        <h2 class="text-xl font-bold">{{ $k->nama_kelas }}</h2>
                        <p class="text-sm">{{ $k->kode_kelas }}</p>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 mb-2">
                            <strong>Instruktur:</strong> {{ $k->instruktur->name }}
                        </p>
                        <p class="text-gray-600 mb-2">
                            <strong>Mahasiswa:</strong> {{ $k->mahasiswas->count() }} orang
                        </p>
                        @if($k->deskripsi)
                            <p class="text-gray-600 mb-4">{{ Str::limit($k->deskripsi, 100) }}</p>
                        @endif
                        
                        <div class="border-t pt-4">
                            <h4 class="font-semibold mb-2">Jadwal</h4>
                            @forelse($k->jadwals as $jadwal)
                                <p class="text-sm text-gray-600">
                                    {{ $jadwal->hari }} | {{ $jadwal->jam_mulai->format('H:i') }} - {{ $jadwal->jam_selesai->format('H:i') }}
                                    @if($jadwal->ruangan)
                                        | {{ $jadwal->ruangan }}
                                    @endif
                                </p>
                            @empty
                                <p class="text-sm text-gray-500">Belum ada jadwal</p>
                            @endforelse
                        </div>

                        <a href="{{ route('kelas.show', $k->id) }}" class="mt-4 block bg-blue-500 text-white text-center py-2 rounded hover:bg-blue-600 transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
