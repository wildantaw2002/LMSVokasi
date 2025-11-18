<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\Submission;
use App\Models\Nilai;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Dashboard guru
     */
    public function dashboard()
    {
        $guru = auth()->user();
        $kelas = Kelas::where('instruktur_id', $guru->id)->get();
        $totalKelas = $kelas->count();
        $totalTugas = Tugas::whereIn('kelas_id', $kelas->pluck('id'))->count();
        $totalSubmission = Submission::whereIn('tugas_id', Tugas::whereIn('kelas_id', $kelas->pluck('id'))->pluck('id'))->count();

        return view('guru.dashboard', compact('totalKelas', 'totalTugas', 'totalSubmission', 'kelas'));
    }

    /**
     * Daftar kelas guru
     */
    public function kelas()
    {
        $guru = auth()->user();
        $kelas = Kelas::where('instruktur_id', $guru->id)->with('mahasiswas')->paginate(10);

        return view('guru.kelas.index', compact('kelas'));
    }

    /**
     * Detail kelas guru
     */
    public function kelasDetail($id)
    {
        $kelas = Kelas::findOrFail($id);
        
        // Check if guru owns this class
        if ($kelas->instruktur_id != auth()->id()) {
            abort(403);
        }

        $kelas->load(['mahasiswas', 'tugas', 'jadwals']);

        return view('guru.kelas.detail', compact('kelas'));
    }

    /**
     * Daftar tugas guru
     */
    public function tugas()
    {
        $guru = auth()->user();
        $kelas = Kelas::where('instruktur_id', $guru->id)->pluck('id');
        $tugas = Tugas::whereIn('kelas_id', $kelas)->with('kelas')->paginate(10);

        return view('guru.tugas.index', compact('tugas'));
    }

    /**
     * Form create tugas
     */
    public function createTugas()
    {
        $guru = auth()->user();
        $kelas = Kelas::where('instruktur_id', $guru->id)->get();
        return view('guru.tugas.create', compact('kelas'));
    }

    /**
     * Store tugas baru
     */
    public function storeTugas(Request $request)
    {
        $guru = auth()->user();

        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'judul_tugas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_deadline' => 'required|date|after:tanggal_mulai',
            'file_materi' => 'nullable|file|max:10240',
        ]);

        // Check if kelas belongs to guru
        $kelas = Kelas::findOrFail($validated['kelas_id']);
        if ($kelas->instruktur_id != $guru->id) {
            abort(403);
        }

        if ($request->hasFile('file_materi')) {
            $validated['file_materi'] = $request->file('file_materi')->store('materi');
        }

        Tugas::create($validated);

        return redirect()->route('guru.tugas')->with('success', 'Tugas berhasil dibuat');
    }

    /**
     * Edit tugas form
     */
    public function editTugas($id)
    {
        $tugas = Tugas::findOrFail($id);
        $guru = auth()->user();

        // Check ownership
        $kelas = Kelas::findOrFail($tugas->kelas_id);
        if ($kelas->instruktur_id != $guru->id) {
            abort(403);
        }

        $kelas = Kelas::where('instruktur_id', $guru->id)->get();
        return view('guru.tugas.edit', compact('tugas', 'kelas'));
    }

    /**
     * Update tugas
     */
    public function updateTugas(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);
        $guru = auth()->user();

        $kelas = Kelas::findOrFail($tugas->kelas_id);
        if ($kelas->instruktur_id != $guru->id) {
            abort(403);
        }

        $validated = $request->validate([
            'judul_tugas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_deadline' => 'required|date|after:tanggal_mulai',
            'file_materi' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('file_materi')) {
            $validated['file_materi'] = $request->file('file_materi')->store('materi');
        }

        $tugas->update($validated);

        return redirect()->route('guru.tugas')->with('success', 'Tugas berhasil diupdate');
    }

    /**
     * Delete tugas
     */
    public function deleteTugas($id)
    {
        $tugas = Tugas::findOrFail($id);
        $guru = auth()->user();

        $kelas = Kelas::findOrFail($tugas->kelas_id);
        if ($kelas->instruktur_id != $guru->id) {
            abort(403);
        }

        $tugas->delete();

        return redirect()->route('guru.tugas')->with('success', 'Tugas berhasil dihapus');
    }

    /**
     * Daftar submission
     */
    public function submission()
    {
        $guru = auth()->user();
        $guruKelas = Kelas::where('instruktur_id', $guru->id)->pluck('id');
        
        // Get all tugas from guru's classes
        $tugasIds = Tugas::whereIn('kelas_id', $guruKelas)->pluck('id');
        
        // Get submissions with proper relationships
        $query = Submission::whereIn('tugas_id', $tugasIds)
            ->with(['tugas.kelas']);
        
        // Filter by kelas if provided
        if (request('kelas_id')) {
            $query->whereHas('tugas', function ($q) {
                $q->where('kelas_id', request('kelas_id'));
            });
        }
        
        $submissions = $query->paginate(10);
        
        // Get guru's kelas for filter dropdown
        $kelas = Kelas::where('instruktur_id', $guru->id)->get();

        return view('guru.submission.index', compact('submissions', 'kelas'));
    }

    /**
     * Detail submission
     */
    public function submissionDetail($id)
    {
        $submission = Submission::with(['tugas', 'tugas.kelas'])->findOrFail($id);
        $guru = auth()->user();

        // Check ownership
        $kelas = Kelas::findOrFail($submission->tugas->kelas_id);
        if ($kelas->instruktur_id != $guru->id) {
            abort(403);
        }

        return view('guru.submission.detail', compact('submission'));
    }

    /**
     * Beri nilai
     */
    public function gradeSubmission(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);
        $guru = auth()->user();

        $kelas = Kelas::findOrFail($submission->tugas->kelas_id);
        if ($kelas->instruktur_id != $guru->id) {
            abort(403);
        }

        $validated = $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'feedback' => 'nullable|string',
        ]);

        // Create or update nilai record
        Nilai::updateOrCreate(
            [
                'tugas_id' => $submission->tugas_id,
                'mahasiswa_id' => $submission->mahasiswa_id,
            ],
            $validated
        );

        $submission->update(['status' => 'graded']);

        return redirect()->route('guru.submission.detail', $submission->id)->with('success', 'Nilai berhasil disimpan');
    }
}
