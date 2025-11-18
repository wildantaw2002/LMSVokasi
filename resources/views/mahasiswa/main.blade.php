@extends ('layout.app')
@section('title', 'Dashboard Mahasiswa')
@section('content')
    
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Dashboard Mahasiswa</h1>

    <!-- Kelas Terdaftar -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Kelas Saya</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($kelas as $k)
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h3 class="text-lg font-semibold">{{ $k->nama_kelas }}</h3>
                    <p class="text-gray-600">Kode: {{ $k->kode_kelas }}</p>
                    <p class="text-gray-600">Instruktur: {{ $k->instruktur->name }}</p>
                    <a href="{{ route('mahasiswa.kelas.detail', $k->id) }}" class="text-blue-500 hover:text-blue-700 mt-2">Lihat Kelas →</a>
                </div>
            @empty
                <p class="text-gray-500">Anda belum terdaftar di kelas manapun</p>
            @endforelse
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Tugas Mendatang -->
        <div>
            <h2 class="text-2xl font-semibold mb-4">Tugas Mendatang</h2>
            <div class="space-y-3">
                @forelse($tugasMendatang as $tugas)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <h3 class="text-lg font-semibold">{{ $tugas->judul_tugas }}</h3>
                        <p class="text-gray-600">{{ $tugas->kelas->nama_kelas }}</p>
                        <p class="text-sm text-red-600">Deadline: {{ $tugas->tanggal_deadline->format('d/m/Y H:i') }}</p>
                        <a href="{{ route('mahasiswa.tugas.detail', $tugas->id) }}" class="text-blue-500 hover:text-blue-700 mt-2">Lihat Tugas →</a>
                    </div>
                @empty
                    <p class="text-gray-500">Tidak ada tugas mendatang</p>
                @endforelse
            </div>
        </div>

        <!-- Nilai Terbaru -->
        <div>
            <h2 class="text-2xl font-semibold mb-4">Nilai Terbaru</h2>
            <div class="space-y-3">
                @forelse($nilaiTerbaru as $nilai)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <h3 class="text-lg font-semibold">{{ $nilai->tugas->judul_tugas }}</h3>
                        <p class="text-gray-600">{{ $nilai->tugas->kelas->nama_kelas }}</p>
                        <p class="text-lg font-bold text-green-600">Nilai: {{ $nilai->nilai ?? 'Belum dinilai' }}</p>
                        @if($nilai->feedback)
                            <p class="text-sm text-gray-600 mt-2">{{ $nilai->feedback }}</p>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada nilai</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('mahasiswa.tugas') }}" class="bg-blue-500 text-white rounded-lg shadow-md p-4 text-center hover:bg-blue-600">
            <p class="text-lg font-semibold">Semua Tugas</p>
        </a>
        <a href="{{ route('mahasiswa.kelas') }}" class="bg-green-500 text-white rounded-lg shadow-md p-4 text-center hover:bg-green-600">
            <p class="text-lg font-semibold">Semua Kelas</p>
        </a>
        <a href="{{ route('mahasiswa.curhat') }}" class="bg-purple-500 text-white rounded-lg shadow-md p-4 text-center hover:bg-purple-600">
            <p class="text-lg font-semibold">Forum Curhat</p>
        </a>
    </div>
</div>

@endsection