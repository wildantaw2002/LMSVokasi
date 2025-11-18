@extends('layout.app')
@section('title', 'Detail Submission & Grading')
@section('content')

<div class="container mx-auto px-4 py-8">
    <a href="{{ route('guru.submission') }}" class="text-blue-500 hover:text-blue-700 mb-4 inline-block">← Kembali</a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Submission Info -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h1 class="text-3xl font-bold mb-4">{{ $submission->tugas->judul_tugas }}</h1>

                <div class="mb-6">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold">Mahasiswa</label>
                        @php
                            $mahasiswa = \App\Models\User::find($submission->mahasiswa_id);
                        @endphp
                        <p class="text-lg">{{ $mahasiswa ? $mahasiswa->name : 'N/A' }} ({{ $mahasiswa ? $mahasiswa->email : 'N/A' }})</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold">Kelas</label>
                        <p class="text-lg">{{ $submission->tugas->kelas->nama_kelas }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold">Waktu Pengumpulan</label>
                        <p class="text-lg">{{ $submission->created_at->format('d/m/Y H:i:s') }}</p>
                        @if($submission->created_at > $submission->tugas->tanggal_deadline)
                            <p class="text-red-600 text-sm mt-1">⚠️ Terlambat</p>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold">Deadline</label>
                        <p class="text-lg">{{ $submission->tugas->tanggal_deadline->format('d/m/Y H:i:s') }}</p>
                    </div>
                </div>

                <!-- File Submission -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">File Submission</label>
                    @if($submission->file_submission)
                        <div class="p-3 bg-gray-100 rounded">
                            <a href="{{ Storage::url($submission->file_submission) }}" target="_blank" class="text-blue-600 hover:text-blue-800 break-words">
                                📄 {{ basename($submission->file_submission) }}
                            </a>
                        </div>
                    @else
                        <p class="text-gray-500">Tidak ada file</p>
                    @endif
                </div>

                <!-- Submission Description/Notes -->
                @if($submission->catatan)
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Catatan Siswa</label>
                        <div class="p-4 bg-gray-50 rounded border border-gray-300">
                            {{ $submission->catatan }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Grading Panel -->
        <div>
            <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                <h2 class="text-xl font-bold mb-4">Penilaian</h2>

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded text-sm">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('guru.submission.grade', $submission->id) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="nilai" class="block text-gray-700 text-sm font-bold mb-2">Nilai (0-100)</label>
                        @php
                            $nilai = \App\Models\Nilai::where('tugas_id', $submission->tugas_id)
                                ->where('mahasiswa_id', $submission->mahasiswa_id)
                                ->first();
                        @endphp
                        <input type="number" name="nilai" id="nilai" min="0" max="100" 
                            value="{{ old('nilai', $nilai ? $nilai->nilai : '') }}" 
                            class="w-full px-3 py-2 border border-gray-300 rounded" required>
                        @error('nilai')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="feedback" class="block text-gray-700 text-sm font-bold mb-2">Feedback</label>
                        <textarea name="feedback" id="feedback" class="w-full px-3 py-2 border border-gray-300 rounded" 
                            rows="4" placeholder="Berikan feedback kepada siswa...">{{ old('feedback', $nilai ? $nilai->feedback : '') }}</textarea>
                        @error('feedback')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Simpan Nilai & Feedback
                    </button>
                </form>

                <!-- Current Grade Info -->
                @if($nilai)
                    <div class="mt-6 pt-6 border-t">
                        <p class="text-sm text-gray-600 mb-2">Nilai Terakhir</p>
                        <p class="text-3xl font-bold text-green-600">{{ $nilai->nilai }}</p>
                        <p class="text-xs text-gray-500 mt-2">Diperbarui: {{ $nilai->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
