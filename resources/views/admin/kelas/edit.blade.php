@extends('layout.app')
@section('title', 'Edit Kelas')
@section('content')

<div class="container mx-auto max-w-2xl px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Edit Kelas</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="kode_kelas" class="block text-gray-700 text-sm font-bold mb-2">Kode Kelas</label>
                <input type="text" name="kode_kelas" id="kode_kelas" class="w-full px-3 py-2 border border-gray-300 rounded" 
                    value="{{ old('kode_kelas', $kelas->kode_kelas) }}" required>
                @error('kode_kelas')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nama_kelas" class="block text-gray-700 text-sm font-bold mb-2">Nama Kelas</label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="w-full px-3 py-2 border border-gray-300 rounded" 
                    value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
                @error('nama_kelas')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="w-full px-3 py-2 border border-gray-300 rounded" 
                    rows="4">{{ old('deskripsi', $kelas->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="instruktur_id" class="block text-gray-700 text-sm font-bold mb-2">Instruktur/Guru</label>
                <select name="instruktur_id" id="instruktur_id" class="w-full px-3 py-2 border border-gray-300 rounded" required>
                    @foreach($gurus as $guru)
                        <option value="{{ $guru->id }}" {{ old('instruktur_id', $kelas->instruktur_id) === (string)$guru->id ? 'selected' : '' }}>
                            {{ $guru->name }}
                        </option>
                    @endforeach
                </select>
                @error('instruktur_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                    Update
                </button>
                <a href="{{ route('admin.kelas') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
