@extends('layout.app')
@section('title', 'Forum Curhat Vokasi')
@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-4xl font-bold text-gray-800">Forum Curhat Vokasi</h1>
            <p class="text-gray-600 mt-2">Tempat berbagi cerita, keluh kesah, dan mencari solusi bersama</p>
        </div>
        <a href="{{ route('curhat.create') }}" class="inline-flex items-center bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 shadow-md whitespace-nowrap">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Curhat Baru
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r animation-slideDown">
            <p class="font-bold">✓ Berhasil!</p>
            <p class="text-sm">{{ session('success') }}</p>
        </div>
    @endif

    @if($curhats->isEmpty())
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 text-blue-700 px-6 py-12 rounded-xl text-center">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2l-4 4z"></path>
            </svg>
            <p class="text-lg font-semibold">Belum ada curhat</p>
            <p class="text-sm mt-2">Jadilah yang pertama berbagi cerita dan pengalaman Anda!</p>
        </div>
    @else
        <div class="grid gap-6">
            @foreach($curhats as $curhat)
                <div class="card bg-white rounded-xl shadow-md border border-gray-100 hover:shadow-lg hover:border-blue-200 transition duration-200 overflow-hidden">
                    <div class="p-6">
                        <!-- Header with Avatar -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-start gap-4 flex-1">
                                <div class="w-12 h-12 rounded-full flex-shrink-0 overflow-hidden bg-gradient-to-br from-blue-400 to-blue-600">
                                    @if($curhat->mahasiswa->profile_photo && !str_contains($curhat->mahasiswa->profile_photo, 'ui-avatars'))
                                        <img src="{{ asset('storage/' . $curhat->mahasiswa->profile_photo) }}" alt="{{ $curhat->mahasiswa->name }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ $curhat->mahasiswa->profile_photo ?? 'https://ui-avatars.com/api/?name=' . urlencode($curhat->mahasiswa->name) . '&background=random' }}" alt="{{ $curhat->mahasiswa->name }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h2 class="text-xl font-bold text-gray-800">{{ $curhat->judul }}</h2>
                                    <div class="flex items-center gap-2 mt-1">
                                        <p class="text-sm text-gray-600">{{ $curhat->mahasiswa->name }}</p>
                                        <span class="text-gray-400">•</span>
                                        <p class="text-sm text-gray-500">{{ $curhat->created_at->diffForHumans() }}</p>
                                    </div>
                                    @if($curhat->kategori)
                                        <div class="mt-2">
                                            <span class="inline-block bg-gradient-to-r from-blue-100 to-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold border border-blue-200">
                                                {{ $curhat->kategori }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Content with Image if exists -->
                        <div class="mb-4">
                            <p class="text-gray-700 leading-relaxed">{{ Str::limit($curhat->isi, 200) }}</p>
                            
                            @if($curhat->image)
                                <div class="mt-4 rounded-lg overflow-hidden border border-gray-200 hover:border-blue-300 transition">
                                    <img src="{{ asset('storage/' . $curhat->image) }}" alt="Curhat Image" class="w-full h-48 object-cover hover:scale-105 transition duration-200">
                                </div>
                            @endif
                        </div>

                        <!-- Footer with Stats and Action -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center gap-6 text-sm text-gray-600">
                                <span class="inline-flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2l-4 4z"></path>
                                    </svg>
                                    {{ $curhat->balasan->count() }} Balasan
                                </span>
                            </div>
                            <a href="{{ route('curhat.show', $curhat->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold inline-flex items-center gap-1 transition">
                                Lihat Selengkapnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $curhats->links() }}
        </div>
    @endif
</div>

<style>
    .animation-slideDown {
        animation: slideDown 0.3s ease-out;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

@endsection