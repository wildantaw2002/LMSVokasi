@extends('layout.app')
@section('title', 'Admin Dashboard')
@section('content')

<div class="space-y-8">
    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users Card -->
        <div class="card bg-white rounded-xl shadow-md border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Users</p>
                    <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalUsers }}</p>
                    <p class="text-xs text-gray-500 mt-2">Semua pengguna sistem</p>
                </div>
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 12a6 6 0 11-12 0 6 6 0 0112 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Mahasiswa Card -->
        <div class="card bg-white rounded-xl shadow-md border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Mahasiswa</p>
                    <p class="text-4xl font-bold text-green-600 mt-2">{{ $totalMahasiswa }}</p>
                    <p class="text-xs text-gray-500 mt-2">Siswa aktif</p>
                </div>
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Guru Card -->
        <div class="card bg-white rounded-xl shadow-md border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Guru</p>
                    <p class="text-4xl font-bold text-purple-600 mt-2">{{ $totalGuru }}</p>
                    <p class="text-xs text-gray-500 mt-2">Pengajar</p>
                </div>
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5M6.5 10.5l3 3 5-5M16 4v5h5"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Kelas Card -->
        <div class="card bg-white rounded-xl shadow-md border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Kelas</p>
                    <p class="text-4xl font-bold text-orange-600 mt-2">{{ $totalKelas }}</p>
                    <p class="text-xs text-gray-500 mt-2">Kelas aktif</p>
                </div>
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('admin.users') }}" class="group card bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-md p-8 text-white hover:shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold mb-2">Kelola Users</h3>
                    <p class="text-blue-100">Tambah, edit, atau hapus pengguna sistem</p>
                </div>
                <svg class="w-12 h-12 opacity-50 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 12a6 6 0 11-12 0 6 6 0 0112 0z"/>
                </svg>
            </div>
            <div class="mt-4 text-blue-100 text-sm font-semibold group-hover:translate-x-2 transition-transform">
                Buka → 
            </div>
        </a>

        <a href="{{ route('admin.kelas') }}" class="group card bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-md p-8 text-white hover:shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold mb-2">Kelola Kelas</h3>
                    <p class="text-green-100">Buat, edit kelas dan kelola siswa</p>
                </div>
                <svg class="w-12 h-12 opacity-50 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                </svg>
            </div>
            <div class="mt-4 text-green-100 text-sm font-semibold group-hover:translate-x-2 transition-transform">
                Buka → 
            </div>
        </a>
    </div>

    <!-- Info Section -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200 p-6">
        <div class="flex items-start space-x-4">
            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2z"/>
            </svg>
            <div>
                <h4 class="font-semibold text-blue-900 mb-1">Statistik Real-time</h4>
                <p class="text-sm text-blue-800">Dashboard ini menampilkan data real-time dari sistem LMS Vokasi. Data diperbarui otomatis setiap kali ada perubahan data.</p>
            </div>
        </div>
    </div>
</div>

@endsection
