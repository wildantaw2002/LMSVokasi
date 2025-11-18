<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Tampilkan daftar nilai
     */
    public function index()
    {
        $mahasiswa = auth()->user();
        
        $nilai = Nilai::where('mahasiswa_id', $mahasiswa->id)
            ->with('tugas.kelas')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Calculate average
        $rataRata = Nilai::where('mahasiswa_id', $mahasiswa->id)
            ->whereNotNull('nilai')
            ->avg('nilai');

        return view('mahasiswa.nilai', compact('nilai', 'rataRata'));
    }
}
