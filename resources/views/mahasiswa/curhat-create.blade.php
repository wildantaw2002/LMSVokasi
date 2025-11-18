@extends('layout.app')
@section('title', 'Buat Curhat Baru')
@section('content')

<div class="container mx-auto px-4 py-8 max-w-3xl">
    <div class="mb-8">
        <a href="{{ route('curhat.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Curhat
        </a>

        <h1 class="text-4xl font-bold text-gray-800">Buat Curhat Baru</h1>
        <p class="text-gray-600 mt-2">Bagikan cerita atau keluhan Anda kepada konselor</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r">
            <p class="font-bold mb-2">Terjadi kesalahan:</p>
            @foreach ($errors->all() as $error)
                <p class="text-sm">• {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
        <form action="{{ route('curhat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Judul -->
            <div class="mb-6">
                <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">
                    Judul Curhat <span class="text-red-600">*</span>
                </label>
                <input type="text" name="judul" id="judul" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                    placeholder="Berikan judul untuk curhat Anda"
                    value="{{ old('judul') }}">
                @error('judul')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="mb-6">
                <label for="kategori" class="block text-gray-700 text-sm font-bold mb-2">
                    Kategori
                </label>
                <select name="kategori" id="kategori"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Akademik" {{ old('kategori') === 'Akademik' ? 'selected' : '' }}>Akademik</option>
                    <option value="Kesehatan" {{ old('kategori') === 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                    <option value="Karir" {{ old('kategori') === 'Karir' ? 'selected' : '' }}>Karir</option>
                    <option value="Pribadi" {{ old('kategori') === 'Pribadi' ? 'selected' : '' }}>Pribadi</option>
                    <option value="Teknis" {{ old('kategori') === 'Teknis' ? 'selected' : '' }}>Teknis</option>
                </select>
                @error('kategori')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Isi Curhat -->
            <div class="mb-6">
                <label for="isi" class="block text-gray-700 text-sm font-bold mb-2">
                    Isi Curhat <span class="text-red-600">*</span>
                </label>
                <textarea name="isi" id="isi" rows="8" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                    placeholder="Ceritakan masalah atau keluhan Anda di sini...">{{ old('isi') }}</textarea>
                @error('isi')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload -->
            <div class="mb-8 pb-8 border-b border-gray-200">
                <label class="block text-gray-700 text-sm font-bold mb-4">
                    Upload Gambar/Screenshot (Opsional)
                </label>
                <div class="flex gap-6 items-start">
                    <div class="flex-shrink-0">
                        <div id="previewContainer" class="w-32 h-32 bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden">
                            <img id="preview" src="" alt="Preview" class="hidden w-full h-full object-cover">
                            <svg id="defaultIcon" class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <input type="file" name="image" id="curhatImage" accept="image/*" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, GIF. Ukuran maksimal: 2MB</p>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 shadow-md">
                    <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    Kirim Curhat
                </button>
                <a href="{{ route('curhat.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg transition duration-200 text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('curhatImage').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview');
    const defaultIcon = document.getElementById('defaultIcon');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            preview.src = event.target.result;
            preview.classList.remove('hidden');
            defaultIcon.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
        defaultIcon.classList.remove('hidden');
    }
});
</script>

@endsection
