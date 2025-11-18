@extends('layout.app')
@section('title', 'Kelola Kelas')
@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Kelola Kelas</h1>
        <a href="{{ route('admin.kelas.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Kelas
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Kode Kelas</th>
                    <th class="px-4 py-2 text-left">Nama Kelas</th>
                    <th class="px-4 py-2 text-left">Instruktur</th>
                    <th class="px-4 py-2 text-left">Mahasiswa</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelas as $k)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ ($kelas->currentPage() - 1) * $kelas->perPage() + $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $k->kode_kelas }}</td>
                        <td class="px-4 py-2">{{ $k->nama_kelas }}</td>
                        <td class="px-4 py-2">{{ $k->instruktur->name }}</td>
                        <td class="px-4 py-2">{{ $k->mahasiswas()->count() }} siswa</td>
                        <td class="px-4 py-2 space-x-1">
                            <a href="{{ route('admin.kelas.edit', $k->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-2 rounded text-sm inline-block">
                                Edit
                            </a>
                            <a href="{{ route('admin.kelas.manage-students', $k->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded text-sm inline-block">
                                Siswa
                            </a>
                            <form action="{{ route('admin.kelas.delete', $k->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
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
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">Tidak ada data kelas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $kelas->links() }}
    </div>
</div>

@endsection
