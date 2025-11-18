@extends('layout.app')
@section('title', 'Kelola Tugas')
@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Kelola Tugas</h1>
        <a href="{{ route('guru.tugas.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            + Buat Tugas
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
                    <th class="px-4 py-2 text-left">Judul</th>
                    <th class="px-4 py-2 text-left">Kelas</th>
                    <th class="px-4 py-2 text-left">Deadline</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tugas as $t)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ ($tugas->currentPage() - 1) * $tugas->perPage() + $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $t->judul_tugas }}</td>
                        <td class="px-4 py-2">{{ $t->kelas->nama_kelas }}</td>
                        <td class="px-4 py-2">{{ $t->tanggal_deadline->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-2">
                            @if($t->tanggal_deadline < now())
                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm">Selesai</span>
                            @else
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">Aktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 space-x-1">
                            <a href="{{ route('guru.tugas.edit', $t->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-2 rounded text-sm inline-block">
                                Edit
                            </a>
                            <form action="{{ route('guru.tugas.delete', $t->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin?')">
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
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada tugas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $tugas->links() }}
    </div>
</div>

@endsection
