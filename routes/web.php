<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\CurhatController;
use Illuminate\Support\Facades\Route;

// Home - redirect based on role
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role === 'guru') {
            return redirect('/guru/dashboard');
        } else {
            return redirect('/mahasiswa/dashboard');
        }
    }
    return view('welcome');
});

// Dashboard Route (redirect based on role)
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'guru') {
        return redirect()->route('guru.dashboard');
    } else {
        return redirect()->route('mahasiswa.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Breeze Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Account Routes (Custom profile management)
Route::middleware('auth')->group(function () {
    Route::get('/account/profile', [AccountController::class, 'editProfile'])->name('account.profile');
    Route::put('/account/profile', [AccountController::class, 'updateProfile'])->name('account.update-profile');
    Route::get('/account/password', [AccountController::class, 'changePassword'])->name('account.change-password');
    Route::put('/account/password', [AccountController::class, 'updatePassword'])->name('account.update-password');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    
    // Kelas Management
    Route::get('/kelas', [AdminController::class, 'kelas'])->name('admin.kelas');
    Route::get('/kelas/create', [AdminController::class, 'createKelas'])->name('admin.kelas.create');
    Route::post('/kelas', [AdminController::class, 'storeKelas'])->name('admin.kelas.store');
    Route::get('/kelas/{id}/edit', [AdminController::class, 'editKelas'])->name('admin.kelas.edit');
    Route::put('/kelas/{id}', [AdminController::class, 'updateKelas'])->name('admin.kelas.update');
    Route::delete('/kelas/{id}', [AdminController::class, 'deleteKelas'])->name('admin.kelas.delete');
    Route::get('/kelas/{id}/students', [AdminController::class, 'manageStudents'])->name('admin.kelas.manage-students');
    Route::post('/kelas/{id}/students', [AdminController::class, 'addStudent'])->name('admin.kelas.students.add');
    Route::delete('/kelas/{kelasId}/students/{mahasiswaId}', [AdminController::class, 'removeStudent'])->name('admin.kelas.students.remove');
});

// Guru Routes
Route::middleware(['auth', 'guru'])->prefix('guru')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    
    // Kelas
    Route::get('/kelas', [GuruController::class, 'kelas'])->name('guru.kelas');
    Route::get('/kelas/{id}', [GuruController::class, 'kelasDetail'])->name('guru.kelas.detail');
    
    // Tugas
    Route::get('/tugas', [GuruController::class, 'tugas'])->name('guru.tugas');
    Route::get('/tugas/create', [GuruController::class, 'createTugas'])->name('guru.tugas.create');
    Route::post('/tugas', [GuruController::class, 'storeTugas'])->name('guru.tugas.store');
    Route::get('/tugas/{id}/edit', [GuruController::class, 'editTugas'])->name('guru.tugas.edit');
    Route::put('/tugas/{id}', [GuruController::class, 'updateTugas'])->name('guru.tugas.update');
    Route::delete('/tugas/{id}', [GuruController::class, 'deleteTugas'])->name('guru.tugas.delete');
    
    // Submissions
    Route::get('/submissions', [GuruController::class, 'submission'])->name('guru.submissions');
    Route::get('/submissions/{id}', [GuruController::class, 'submissionDetail'])->name('guru.submissions.detail');
    Route::post('/submissions/{id}/grade', [GuruController::class, 'gradeSubmission'])->name('guru.submissions.grade');
});

// Mahasiswa Routes
Route::middleware(['auth', 'mahasiswa'])->prefix('mahasiswa')->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    
    // Kelas
    Route::get('/kelas', [KelasController::class, 'index'])->name('mahasiswa.kelas');
    Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('mahasiswa.kelas.detail');
    
    // Tugas
    Route::get('/tugas', [TugasController::class, 'index'])->name('mahasiswa.tugas');
    Route::get('/tugas/{id}', [TugasController::class, 'show'])->name('mahasiswa.tugas.detail');
    Route::post('/tugas/{id}/submit', [TugasController::class, 'submit'])->name('mahasiswa.tugas.submit');
    
    // Curhat
    Route::get('/curhat', [CurhatController::class, 'index'])->name('mahasiswa.curhat');
    Route::get('/curhat/create', [CurhatController::class, 'create'])->name('mahasiswa.curhat.create');
    Route::post('/curhat', [CurhatController::class, 'store'])->name('mahasiswa.curhat.store');
    Route::get('/curhat/{id}', [CurhatController::class, 'show'])->name('mahasiswa.curhat.detail');
    Route::post('/curhat/{id}/balasan', [CurhatController::class, 'storeBalasan'])->name('mahasiswa.curhat.balasan');
});

require __DIR__.'/auth.php';
