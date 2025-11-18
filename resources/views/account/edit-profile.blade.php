@extends('layout.app')
@section('title', 'Pengaturan Akun')
@section('content')

<div class="container mx-auto max-w-2xl">
    <h1 class="text-3xl font-bold mb-8">Pengaturan Akun</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Edit Profile Tab -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-2xl font-bold mb-6 border-b pb-3">Edit Profil</h2>
        
        <form action="{{ route('account.update-profile') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded" 
                    value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded" 
                    value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                <p class="px-3 py-2 bg-gray-100 border border-gray-300 rounded">
                    <span class="font-semibold">{{ ucfirst($user->role) }}</span>
                </p>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                Simpan Profil
            </button>
        </form>
    </div>

    <!-- Change Password Tab -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-6 border-b pb-3">Ubah Password</h2>
        
        <a href="{{ route('account.change-password') }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
            Ubah Password
        </a>
    </div>
</div>

@endsection
