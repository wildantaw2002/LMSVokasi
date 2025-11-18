@extends('layout.app')
@section('title', 'Edit User')
@section('content')

<div class="container mx-auto max-w-2xl px-4 py-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800">Edit User</h1>
        <p class="text-gray-600 mt-2">Perbarui informasi pengguna</p>
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
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Profile Photo Section -->
            <div class="mb-8 pb-8 border-b border-gray-200">
                <label class="block text-gray-700 text-sm font-bold mb-4">Foto Profil</label>
                <div class="flex gap-6 items-start">
                    <div class="flex-shrink-0">
                        <div id="previewContainer" class="w-32 h-32 bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden">
                            @if($user->profile_photo && !str_contains($user->profile_photo, 'ui-avatars'))
                                <img id="preview" src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile" class="w-full h-full object-cover">
                            @else
                                <img id="preview" src="{{ $user->profile_photo ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random' }}" alt="Profile" class="w-full h-full object-cover">
                            @endif
                        </div>
                    </div>
                    <div class="flex-1">
                        <input type="file" name="profile_photo" id="profilePhoto" accept="image/*" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG. Ukuran maksimal: 2MB</p>
                        <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah foto</p>
                    </div>
                </div>
            </div>

            <!-- User Information -->
            <div class="mb-6">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    value="{{ old('name', $user->name) }}" placeholder="Masukkan nama lengkap" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    value="{{ old('email', $user->email) }}" placeholder="nama@example.com" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8">
                <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                <select name="role" id="role" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="guru" {{ old('role', $user->role) === 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="mahasiswa" {{ old('role', $user->role) === 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 shadow-md">
                    <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update User
                </button>
                <a href="{{ route('admin.users') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg transition duration-200 text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('profilePhoto').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            preview.src = event.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>

@endsection
