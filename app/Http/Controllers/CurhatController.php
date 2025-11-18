<?php

namespace App\Http\Controllers;

use App\Models\Curhat;
use App\Models\CurhatBalasan;
use Illuminate\Http\Request;

class CurhatController extends Controller
{
    /**
     * Tampilkan daftar curhat
     */
    public function index()
    {
        $curhats = Curhat::with(['mahasiswa', 'balasan.user'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('mahasiswa.CurhatVokasi', compact('curhats'));
    }

    /**
     * Tampilkan form membuat curhat
     */
    public function create()
    {
        return view('mahasiswa.curhat-create');
    }

    /**
     * Simpan curhat baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('curhats', 'public');
        }

        Curhat::create([
            'mahasiswa_id' => auth()->id(),
            'judul' => $request->judul,
            'isi' => $request->isi,
            'kategori' => $request->kategori,
            'image' => $imagePath,
        ]);

        return redirect()->route('curhat.index')->with('success', 'Curhat berhasil dibuat');
    }

    /**
     * Tampilkan detail curhat
     */
    public function show($id)
    {
        $curhat = Curhat::with(['mahasiswa', 'balasan.user'])->findOrFail($id);

        return view('mahasiswa.curhat-detail', compact('curhat'));
    }

    /**
     * Simpan balasan curhat
     */
    public function storeBalasan(Request $request, $id)
    {
        $request->validate([
            'isi_balasan' => 'required|string',
        ]);

        $curhat = Curhat::findOrFail($id);

        CurhatBalasan::create([
            'curhat_id' => $id,
            'user_id' => auth()->id(),
            'isi_balasan' => $request->isi_balasan,
        ]);

        return redirect()->route('curhat.show', $id)->with('success', 'Balasan berhasil ditambahkan');
    }
}
