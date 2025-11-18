@extends('layout.app')
@section('title', 'Daftar Nilai')
@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Daftar Nilai</h1>

    @if($nilai->isEmpty())
        <div class="bg-gray-100 border border-gray-300 text-gray-700 px-4 py-3 rounded">
            Belum ada nilai yang diterima.
        </div>
    @else
        <div class="mb-6 bg-white rounded-lg shadow-md p-4">
            <p class="text-gray-700"><strong>Rata-rata Nilai:</strong> 
                <span class="text-2xl font-bold text-green-600">
                    {{ $rataRata ? number_format($rataRata, 2) : 'N/A' }}
                </span>
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full bg-white rounded-lg shadow-md">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left">Tugas</th>
                        <th class="px-6 py-3 text-left">Kelas</th>
                        <th class="px-6 py-3 text-center">Nilai</th>
                        <th class="px-6 py-3 text-left">Feedback</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nilai as $n)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-3">
                                <a href="{{ route('tugas.show', $n->tugas->id) }}" class="text-blue-500 hover:text-blue-700">
                                    {{ $n->tugas->judul_tugas }}
                                </a>
                            </td>
                            <td class="px-6 py-3">{{ $n->tugas->kelas->nama_kelas }}</td>
                            <td class="px-6 py-3 text-center">
                                @if($n->nilai)
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full font-semibold">
                                        {{ $n->nilai }}
                                    </span>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-3">
                                @if($n->feedback)
                                    <p class="text-gray-700">{{ Str::limit($n->feedback, 50) }}</p>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-gray-600">
                                {{ $n->created_at->format('d/m/Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $nilai->links() }}
        </div>
    @endif
</div>

@endsection
