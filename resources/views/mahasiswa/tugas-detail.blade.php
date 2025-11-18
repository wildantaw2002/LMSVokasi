@extends('layout.app')
@section('title', 'Detail Tugas')
@section('content')

<div class="container mx-auto px-4 py-8">
    <a href="{{ route('tugas.index') }}" class="text-blue-500 hover:text-blue-700 mb-4">← Kembali</a>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold mb-2">{{ $tugas->judul_tugas }}</h1>
        <p class="text-gray-600 mb-4">{{ $tugas->kelas->nama_kelas }} - {{ $tugas->kelas->kode_kelas }}</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-blue-50 p-4 rounded">
                <p class="text-gray-600">Mulai</p>
                <p class="text-lg font-semibold">{{ $tugas->tanggal_mulai->format('d/m/Y H:i') }}</p>
            </div>
            <div class="bg-red-50 p-4 rounded">
                <p class="text-gray-600">Deadline</p>
                <p class="text-lg font-semibold text-red-600">{{ $tugas->tanggal_deadline->format('d/m/Y H:i') }}</p>
            </div>
            <div class="bg-green-50 p-4 rounded">
                <p class="text-gray-600">Status</p>
                @if($submission)
                    <p class="text-lg font-semibold text-green-600">Sudah Submit</p>
                @else
                    <p class="text-lg font-semibold text-red-600">Belum Submit</p>
                @endif
            </div>
        </div>

        <div class="border-b pb-6 mb-6">
            <h2 class="text-2xl font-semibold mb-3">Deskripsi</h2>
            <p class="text-gray-700">{{ $tugas->deskripsi }}</p>
        </div>

        @if($tugas->file_materi)
            <div class="mb-6">
                <h2 class="text-2xl font-semibold mb-3">File Materi</h2>
                <a href="{{ asset('storage/' . $tugas->file_materi) }}" class="text-blue-500 hover:text-blue-700">
                    📥 Download File
                </a>
            </div>
        @endif

        @if($nilai)
            <div class="bg-green-50 border border-green-200 rounded p-6 mb-6">
                <h2 class="text-2xl font-semibold mb-3">Nilai</h2>
                <p class="text-3xl font-bold text-green-600 mb-3">{{ $nilai->nilai }}</p>
                @if($nilai->feedback)
                    <div>
                        <p class="text-gray-600 font-semibold mb-2">Feedback:</p>
                        <p class="text-gray-700">{{ $nilai->feedback }}</p>
                    </div>
                @endif
            </div>
        @endif

        @if($submission)
            <div class="bg-blue-50 border border-blue-200 rounded p-6">
                <h2 class="text-2xl font-semibold mb-3">Submission Anda</h2>
                <p class="text-gray-600 mb-2">
                    <strong>Disubmit:</strong> {{ $submission->tanggal_submit->format('d/m/Y H:i') }}
                </p>
                <p class="text-gray-600 mb-4">
                    <strong>Status:</strong> 
                    <span class="px-3 py-1 rounded-full text-sm 
                        @if($submission->status === 'submitted')
                            bg-green-100 text-green-800
                        @elseif($submission->status === 'late')
                            bg-red-100 text-red-800
                        @else
                            bg-blue-100 text-blue-800
                        @endif
                    ">
                        {{ ucfirst($submission->status) }}
                    </span>
                </p>
                <a href="{{ asset('storage/' . $submission->file_submission) }}" class="text-blue-500 hover:text-blue-700">
                    📥 Download Submission Anda
                </a>
            </div>
        @else
            <div class="bg-yellow-50 border border-yellow-200 rounded p-6">
                <h2 class="text-2xl font-semibold mb-3">Submit Tugas</h2>
                <p class="text-gray-700 mb-4">Anda belum mengirimkan tugas ini. Silakan upload file Anda di bawah.</p>
                
                @if(now() <= $tugas->tanggal_deadline)
                    <form action="{{ route('tugas.submit', $tugas->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="file_submission" class="block text-gray-700 font-semibold mb-2">
                                Pilih File
                            </label>
                            <input type="file" name="file_submission" id="file_submission" required 
                                   class="block w-full text-sm text-gray-500
                                       file:mr-4 file:py-2 file:px-4
                                       file:rounded-lg file:border-0
                                       file:text-sm file:font-semibold
                                       file:bg-blue-50 file:text-blue-700
                                       hover:file:bg-blue-100">
                            @error('file_submission')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition">
                            Submit Tugas
                        </button>
                    </form>
                @else
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        Deadline sudah terlewat. Anda tidak lagi bisa mengirimkan tugas ini.
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>

@endsection
