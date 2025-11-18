<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\Curhat;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Dashboard utama mahasiswa
     */
    public function index()
    {
        $mahasiswa = auth()->user();
        
        $kelas = $mahasiswa->kelas()->with('instruktur')->get();
        $tugasMendatang = Tugas::whereIn('kelas_id', $kelas->pluck('id'))
            ->where('tanggal_deadline', '>', now())
            ->orderBy('tanggal_deadline')
            ->take(5)
            ->get();
        
        $nilaiTerbaru = \App\Models\Nilai::where('mahasiswa_id', $mahasiswa->id)
            ->with('tugas.kelas')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('mahasiswa.main', compact('kelas', 'tugasMendatang', 'nilaiTerbaru'));
    }
}
