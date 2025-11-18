@extends('layout.app')
@section('title', 'Kelola Mahasiswa - ' . $kelas->nama_kelas)
@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Kelola Mahasiswa: {{ $kelas->nama_kelas }}</h1>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-4 mb-8">
        <!-- Add Student -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Tambah Mahasiswa</h2>
            @if($mahasiswasBelumTerdaftar->count() > 0)
                <form action="{{ route('admin.kelas.add-student', $kelas->id) }}" method="POST" class="flex gap-2">
                    @csrf
                    <select name="mahasiswa_id" class="flex-1 px-3 py-2 border border-gray-300 rounded" required>
                        <option value="">-- Pilih Mahasiswa --</option>
                        @foreach($mahasiswasBelumTerdaftar as $m)
                            <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->email }})</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Tambah
                    </button>
                </form>
            @else
                <p class="text-gray-500">Semua mahasiswa sudah terdaftar di kelas ini</p>
            @endif
        </div>

        <!-- Statistics -->
        <div class="bg-blue-100 rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Statistik</h2>
            <p class="text-gray-700"><strong>Total Mahasiswa:</strong> {{ $mahasiswas->count() }}</p>
        </div>
    </div>

    <!-- List Mahasiswa -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Nama</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswas as $m)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $m->name }}</td>
                        <td class="px-4 py-2">{{ $m->email }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('admin.kelas.remove-student', [$kelas->id, $m->id]) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini dari kelas?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded text-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">Tidak ada mahasiswa di kelas ini</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.kelas') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>
</div>

@endsection
