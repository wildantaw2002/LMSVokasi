@extends('layout.app')
@section('title', 'Guru Dashboard')
@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Guru Dashboard</h1>

    <div class="grid grid-cols-3 gap-4 mb-8">
        <div class="bg-blue-100 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-700">Kelas</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $totalKelas }}</p>
        </div>
        <div class="bg-green-100 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-700">Tugas</h3>
            <p class="text-3xl font-bold text-green-600">{{ $totalTugas }}</p>
        </div>
        <div class="bg-purple-100 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-700">Submission</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $totalSubmission }}</p>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <a href="{{ route('guru.kelas') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded text-center">Kelas Saya</a>
        <a href="{{ route('guru.tugas') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded text-center">Kelola Tugas</a>
        <a href="{{ route('guru.submission') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-3 px-4 rounded text-center">Submission & Nilai</a>
    </div>
</div>

@endsection
