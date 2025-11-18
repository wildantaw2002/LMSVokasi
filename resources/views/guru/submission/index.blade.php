@extends('layout.app')
@section('title', 'Submission & Grading')
@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Submission & Grading</h1>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6">
        <label for="kelas_filter" class="block text-gray-700 text-sm font-bold mb-2">Filter Kelas</label>
        <form action="{{ route('guru.submission') }}" method="GET" class="flex gap-2">
            <select name="kelas_id" id="kelas_filter" class="px-3 py-2 border border-gray-300 rounded" onchange="this.form.submit()">
                <option value="">-- Semua Kelas --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Mahasiswa</th>
                    <th class="px-4 py-2 text-left">Tugas</th>
                    <th class="px-4 py-2 text-left">Kelas</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Nilai</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($submissions as $submission)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ ($submissions->currentPage() - 1) * $submissions->perPage() + $loop->iteration }}</td>
                        <td class="px-4 py-2">
                            @php
                                $mahasiswa = \App\Models\User::find($submission->mahasiswa_id);
                            @endphp
                            {{ $mahasiswa ? $mahasiswa->name : 'N/A' }}
                        </td>
                        <td class="px-4 py-2">{{ $submission->tugas->judul_tugas }}</td>
                        <td class="px-4 py-2">{{ $submission->tugas->kelas->nama_kelas }}</td>
                        <td class="px-4 py-2">
                            @if($submission->status === 'submitted')
                                @if($submission->created_at > $submission->tugas->tanggal_deadline)
                                    <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded text-sm">Terlambat</span>
                                @else
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm">Dikumpulkan</span>
                                @endif
                            @else
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-sm">Dinilai</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            @php
                                $nilai = \App\Models\Nilai::where('tugas_id', $submission->tugas_id)
                                    ->where('mahasiswa_id', $submission->mahasiswa_id)
                                    ->first();
                            @endphp
                            {{ $nilai ? $nilai->nilai : '-' }}
                        </td>
                        <td class="px-4 py-2">
                            <a href="{{ route('guru.submission.detail', $submission->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded text-sm inline-block">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-4 text-center text-gray-500">Belum ada submission</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $submissions->links() }}
    </div>
</div>

@endsection
