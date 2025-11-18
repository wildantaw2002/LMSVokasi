@extends('layout.app')
@section('title', 'Curhat - ' . $curhat->judul)
@section('content')

<div class="container mx-auto px-4 py-8 max-w-3xl">
    <a href="{{ route('curhat.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Forum
    </a>

    <!-- Curhat Content -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8 mb-6">
        <!-- Header with Avatar -->
        <div class="flex items-start gap-4 mb-6 pb-6 border-b border-gray-200">
            <div class="w-16 h-16 rounded-full flex-shrink-0 overflow-hidden bg-gradient-to-br from-blue-400 to-blue-600">
                @if($curhat->mahasiswa->profile_photo && !str_contains($curhat->mahasiswa->profile_photo, 'ui-avatars'))
                    <img src="{{ asset('storage/' . $curhat->mahasiswa->profile_photo) }}" alt="{{ $curhat->mahasiswa->name }}" class="w-full h-full object-cover">
                @else
                    <img src="{{ $curhat->mahasiswa->profile_photo ?? 'https://ui-avatars.com/api/?name=' . urlencode($curhat->mahasiswa->name) . '&background=random' }}" alt="{{ $curhat->mahasiswa->name }}" class="w-full h-full object-cover">
                @endif
            </div>
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-gray-800">{{ $curhat->judul }}</h1>
                <div class="flex items-center gap-3 mt-2">
                    <p class="text-gray-600"><strong>{{ $curhat->mahasiswa->name }}</strong></p>
                    <span class="text-gray-400">•</span>
                    <p class="text-sm text-gray-500">{{ $curhat->created_at->format('d M Y, H:i') }}</p>
                </div>
                @if($curhat->kategori)
                    <div class="mt-3">
                        <span class="inline-block bg-gradient-to-r from-blue-100 to-blue-50 text-blue-700 px-4 py-1 rounded-full text-sm font-semibold border border-blue-200">
                            {{ $curhat->kategori }}
                        </span>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Content -->
        <div class="prose prose-sm max-w-none">
            <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $curhat->isi }}</p>
        </div>

        <!-- Image if exists -->
        @if($curhat->image)
            <div class="mt-6 rounded-xl overflow-hidden border border-gray-200 hover:border-blue-300 transition">
                <img src="{{ asset('storage/' . $curhat->image) }}" alt="Curhat Image" class="w-full max-h-96 object-cover hover:scale-105 transition duration-200">
            </div>
        @endif
    </div>

    <!-- Balasan Section -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8 mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Balasan ({{ $curhat->balasan->count() }})</h2>

        @if($curhat->balasan->isEmpty())
            <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-6 rounded-lg text-center">
                <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <p class="font-semibold">Belum ada balasan</p>
                <p class="text-sm mt-1">Jadilah yang pertama memberikan saran atau dukungan!</p>
            </div>
        @else
            <div class="space-y-4 mb-6">
                @foreach($curhat->balasan as $balasan)
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-blue-200 transition">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <strong class="text-gray-800 block">{{ $balasan->user->name }}</strong>
                                <span class="text-sm text-gray-500">{{ $balasan->created_at->diffForHumans() }}</span>
                            </div>
                            @if($balasan->user_id == auth()->id() || auth()->user()->role == 'admin')
                                <a href="{{ route('curhat.deleteBalasan', $balasan->id) }}" class="text-red-500 hover:text-red-700 text-sm" onclick="return confirm('Hapus balasan ini?')">
                                    Hapus
                                </a>
                            @endif
                        </div>
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $balasan->isi_balasan }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Form Balasan -->
    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-200 p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Berikan Balasan</h2>
        
        <form action="{{ route('curhat.storeBalasan', $curhat->id) }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="isi_balasan" class="block text-gray-700 font-semibold mb-2">
                    Balasan Anda
                </label>
                <textarea name="isi_balasan" id="isi_balasan" rows="5" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                    placeholder="Tulis balasan Anda di sini...">
                </textarea>
                @error('isi_balasan')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 shadow-md inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                Kirim Balasan
            </button>
        </form>
    </div>
</div>

@endsection
