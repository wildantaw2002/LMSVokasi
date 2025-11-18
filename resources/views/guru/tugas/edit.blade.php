@extends('layout.app')
@section('title', 'Edit Tugas')
@section('content')

<div class="container mx-auto max-w-2xl px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Edit Tugas</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('guru.tugas.update', $tugas->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="judul_tugas" class="block text-gray-700 text-sm font-bold mb-2">Judul Tugas</label>
                <input type="text" name="judul_tugas" id="judul_tugas" class="w-full px-3 py-2 border border-gray-300 rounded" 
                    value="{{ old('judul_tugas', $tugas->judul_tugas) }}" required>
                @error('judul_tugas')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="w-full px-3 py-2 border border-gray-300 rounded" 
                    rows="5">{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tanggal_mulai" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Mulai</label>
                <input type="datetime-local" name="tanggal_mulai" id="tanggal_mulai" class="w-full px-3 py-2 border border-gray-300 rounded" 
                    value="{{ old('tanggal_mulai', $tugas->tanggal_mulai->format('Y-m-d\TH:i')) }}" required>
                @error('tanggal_mulai')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tanggal_deadline" class="block text-gray-700 text-sm font-bold mb-2">Deadline</label>
                <input type="datetime-local" name="tanggal_deadline" id="tanggal_deadline" class="w-full px-3 py-2 border border-gray-300 rounded" 
                    value="{{ old('tanggal_deadline', $tugas->tanggal_deadline->format('Y-m-d\TH:i')) }}" required>
                @error('tanggal_deadline')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="file_materi" class="block text-gray-700 text-sm font-bold mb-2">Upload File Materi (Opsional)</label>
                @if($tugas->file_materi)
                    <p class="text-sm text-gray-600 mb-2">File saat ini: {{ $tugas->file_materi }}</p>
                @endif
                <input type="file" name="file_materi" id="file_materi" class="w-full px-3 py-2 border border-gray-300 rounded">
                @error('file_materi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                    Update Tugas
                </button>
                <a href="{{ route('guru.tugas') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
