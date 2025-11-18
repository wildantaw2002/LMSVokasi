<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Tugas;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Dashboard admin
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalKelas = Kelas::count();
        $totalTugas = Tugas::count();

        return view('admin.dashboard', compact('totalUsers', 'totalMahasiswa', 'totalGuru', 'totalKelas', 'totalTugas'));
    }

    /**
     * Daftar user management
     */
    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Form create user
     */
    public function createUser()
    {
        return view('admin.users.create');
    }

    /**
     * Store user baru
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,guru,mahasiswa',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profiles', 'public');
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'profile_photo' => $profilePhotoPath ?? 'https://ui-avatars.com/api/?name=' . urlencode($validated['name']) . '&background=random',
        ]);

        return redirect()->route('admin.users')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Edit user form
     */
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,guru,mahasiswa',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profiles', 'public');
            $validated['profile_photo'] = $profilePhotoPath;
        }

        $user->update($validated);

        return redirect()->route('admin.users')->with('success', 'User berhasil diupdate');
    }

    /**
     * Delete user
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus');
    }

    /**
     * Daftar kelas management
     */
    public function kelas()
    {
        $kelas = Kelas::with('instruktur')->paginate(10);
        return view('admin.kelas.index', compact('kelas'));
    }

    /**
     * Form create kelas
     */
    public function createKelas()
    {
        $gurus = User::where('role', 'guru')->get();
        return view('admin.kelas.create', compact('gurus'));
    }

    /**
     * Store kelas baru
     */
    public function storeKelas(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'kode_kelas' => 'required|string|unique:kelas',
            'deskripsi' => 'nullable|string',
            'instruktur_id' => 'required|exists:users,id',
        ]);

        Kelas::create($validated);

        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil dibuat');
    }

    /**
     * Edit kelas form
     */
    public function editKelas($id)
    {
        $kelas = Kelas::findOrFail($id);
        $gurus = User::where('role', 'guru')->get();
        return view('admin.kelas.edit', compact('kelas', 'gurus'));
    }

    /**
     * Update kelas
     */
    public function updateKelas(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'kode_kelas' => 'required|string|unique:kelas,kode_kelas,' . $id,
            'deskripsi' => 'nullable|string',
            'instruktur_id' => 'required|exists:users,id',
        ]);

        $kelas->update($validated);

        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil diupdate');
    }

    /**
     * Delete kelas
     */
    public function deleteKelas($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil dihapus');
    }

    /**
     * Manage mahasiswa di kelas
     */
    public function manageStudents($id)
    {
        $kelas = Kelas::findOrFail($id);
        $mahasiswasTerdaftar = $kelas->mahasiswas()->pluck('user_id')->toArray();
        $mahasiswasBelumTerdaftar = User::where('role', 'mahasiswa')
            ->whereNotIn('id', $mahasiswasTerdaftar)
            ->get();
        $mahasiswas = $kelas->mahasiswas()->get();

        return view('admin.kelas.manage-students', compact('kelas', 'mahasiswas', 'mahasiswasBelumTerdaftar'));
    }

    /**
     * Add mahasiswa ke kelas
     */
    public function addStudent(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $mahasiswa_id = $request->input('mahasiswa_id');

        $kelas->mahasiswas()->attach($mahasiswa_id);

        return redirect()->route('admin.kelas.manage-students', $id)->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    /**
     * Remove mahasiswa dari kelas
     */
    public function removeStudent($kelasId, $mahasiswaId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        $kelas->mahasiswas()->detach($mahasiswaId);

        return redirect()->route('admin.kelas.manage-students', $kelasId)->with('success', 'Mahasiswa berhasil dihapus dari kelas');
    }
}
