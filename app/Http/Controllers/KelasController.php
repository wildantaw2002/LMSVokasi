<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Tampilkan daftar kelas
     */
    public function index()
    {
        $mahasiswa = auth()->user();
        $kelas = $mahasiswa->kelas()->with(['instruktur', 'jadwals'])->get();

        return view('mahasiswa.kelas', compact('kelas'));
    }

    /**
     * Tampilkan detail kelas
     */
    public function show($id)
    {
        $kelas = Kelas::with(['instruktur', 'tugas', 'jadwals', 'mahasiswas'])->findOrFail($id);
        
        $mahasiswa = auth()->user();
        if (!$mahasiswa->kelas()->where('kelas_id', $id)->exists()) {
            abort(403);
        }

        return view('mahasiswa.kelas-detail', compact('kelas'));
    }
}
