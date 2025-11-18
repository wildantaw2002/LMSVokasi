@extends('layout.app')
@section('title', 'Detail Kelas - ' . $kelas->nama_kelas)
@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold">{{ $kelas->nama_kelas }}</h1>
            <p class="text-gray-600">{{ $kelas->kode_kelas }}</p>
        </div>
        <a href="{{ route('guru.kelas') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
            ← Kembali
        </a>
    </div>

    <div class="grid grid-cols-3 gap-4 mb-8">
        <div class="bg-blue-100 p-4 rounded-lg">
            <h3 class="font-bold">Deskripsi</h3>
            <p>{{ $kelas->deskripsi }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded-lg">
            <h3 class="font-bold">Mahasiswa</h3>
            <p class="text-2xl font-bold">{{ $mahasiswas->count() }}</p>
        </div>
        <div class="bg-purple-100 p-4 rounded-lg">
            <h3 class="font-bold">Jadwal</h3>
            <p class="text-sm">{{ $jadwals->count() }} jadwal</p>
        </div>
    </div>

    <!-- Tabs -->
    <div class="bg-white rounded-lg shadow">
        <div class="border-b">
            <div class="flex space-x-4 p-4">
                <a href="#mahasiswa" onclick="switchTab('mahasiswa')" class="tab-btn active px-4 py-2 border-b-2 border-blue-500 font-bold text-blue-500">
                    Mahasiswa
                </a>
                <a href="#jadwal" onclick="switchTab('jadwal')" class="tab-btn px-4 py-2 border-b-2 border-transparent font-bold text-gray-600">
                    Jadwal
                </a>
            </div>
        </div>

        <!-- Mahasiswa Tab -->
        <div id="mahasiswa" class="tab-content p-6">
            <h3 class="text-xl font-bold mb-4">Daftar Mahasiswa</h3>
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">No</th>
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswas as $m)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $m->name }}</td>
                            <td class="px-4 py-2">{{ $m->email }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-center text-gray-500">Tidak ada mahasiswa</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Jadwal Tab -->
        <div id="jadwal" class="tab-content p-6 hidden">
            <h3 class="text-xl font-bold mb-4">Jadwal Kelas</h3>
            @if($jadwals->count() > 0)
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Hari</th>
                            <th class="px-4 py-2 text-left">Jam</th>
                            <th class="px-4 py-2 text-left">Ruangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwals as $j)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $j->hari }}</td>
                                <td class="px-4 py-2">{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                                <td class="px-4 py-2">{{ $j->ruangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">Belum ada jadwal untuk kelas ini</p>
            @endif
        </div>
    </div>
</div>

<script>
    function switchTab(tabName) {
        // Hide all tabs
        const tabs = document.querySelectorAll('.tab-content');
        tabs.forEach(tab => tab.classList.add('hidden'));
        
        // Remove active class from all buttons
        const buttons = document.querySelectorAll('.tab-btn');
        buttons.forEach(btn => {
            btn.classList.remove('border-blue-500', 'text-blue-500');
            btn.classList.add('border-transparent', 'text-gray-600');
        });
        
        // Show selected tab
        document.getElementById(tabName).classList.remove('hidden');
        
        // Add active class to button
        event.target.classList.remove('border-transparent', 'text-gray-600');
        event.target.classList.add('border-blue-500', 'text-blue-500');
    }
</script>

@endsection
