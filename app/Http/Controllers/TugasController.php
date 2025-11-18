<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Submission;
use App\Models\Nilai;
use App\Models\Kelas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    /**
     * Tampilkan daftar tugas
     */
    public function index()
    {
        $mahasiswa = auth()->user();
        $kelas = $mahasiswa->kelas()->pluck('kelas_id');
        
        $tugasBelumSelesai = Tugas::whereIn('kelas_id', $kelas)
            ->where('tanggal_deadline', '>', now())
            ->with(['kelas', 'submissions' => function($query) use ($mahasiswa) {
                $query->where('mahasiswa_id', $mahasiswa->id);
            }])
            ->orderBy('tanggal_deadline')
            ->get();

        $tugasSelesai = Tugas::whereIn('kelas_id', $kelas)
            ->where('tanggal_deadline', '<', now())
            ->with(['kelas', 'submissions' => function($query) use ($mahasiswa) {
                $query->where('mahasiswa_id', $mahasiswa->id);
            }])
            ->orderBy('tanggal_deadline', 'desc')
            ->get();

        return view('mahasiswa.DaftarTugas', compact('tugasBelumSelesai', 'tugasSelesai'));
    }

    /**
     * Tampilkan detail tugas
     */
    public function show($id)
    {
        $tugas = Tugas::with(['kelas', 'submissions', 'nilai'])->findOrFail($id);
        $mahasiswa = auth()->user();
        
        // Check if mahasiswa is enrolled in the class
        if (!$mahasiswa->kelas()->where('kelas_id', $tugas->kelas_id)->exists()) {
            abort(403);
        }

        $submission = Submission::where('tugas_id', $id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->first();

        $nilai = Nilai::where('tugas_id', $id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->first();

        return view('mahasiswa.tugas-detail', compact('tugas', 'submission', 'nilai'));
    }

    /**
     * Submit tugas
     */
    public function submit(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);
        $mahasiswa = auth()->user();

        // Check enrollment
        if (!$mahasiswa->kelas()->where('kelas_id', $tugas->kelas_id)->exists()) {
            abort(403);
        }

        $request->validate([
            'file_submission' => 'required|file|max:10240', // 10MB
        ]);

        // Delete existing submission if any
        Submission::where('tugas_id', $id)->where('mahasiswa_id', $mahasiswa->id)->delete();

        $filePath = $request->file('file_submission')->store('submissions/' . $id);

        $status = now() > $tugas->tanggal_deadline ? 'late' : 'submitted';

        Submission::create([
            'tugas_id' => $id,
            'mahasiswa_id' => $mahasiswa->id,
            'file_submission' => $filePath,
            'status' => $status,
            'tanggal_submit' => now(),
        ]);

        return redirect()->route('tugas.show', $id)->with('success', 'Tugas berhasil disubmit');
    }
}
