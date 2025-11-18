# 🎓 LMS Vokasi - Backend Features

## ✅ Sistem yang Dibuat

### 1️⃣ Dashboard Mahasiswa
- Overview kelas, tugas mendatang, nilai terbaru
- Quick links ke semua fitur

### 2️⃣ Manajemen Kelas
- Daftar kelas yang diambil mahasiswa
- Detail kelas (instruktur, jadwal, tugas)
- Many-to-many relationship dengan mahasiswa

### 3️⃣ Manajemen Tugas
- Daftar tugas belum/sudah selesai
- Submit tugas dengan file upload
- Status: Submitted, Late, Graded
- Validasi deadline

### 4️⃣ Penilaian
- Daftar semua nilai
- Rata-rata nilai
- Feedback dari instruktur
- Integration dengan tugas

### 5️⃣ Forum Curhat (Counseling)
- Buat curhat dengan kategori
- Lihat semua curhat dengan pagination
- Balasan dari pengguna lain
- Kategori: Akademik, Kesehatan, Karir, Pribadi, Teknis

## 📁 File Structure

```
Controllers/
├── MahasiswaController.php
├── KelasController.php
├── TugasController.php
├── NilaiController.php
└── CurhatController.php

Models/
├── User.php
├── Kelas.php
├── Tugas.php
├── Submission.php
├── Nilai.php
├── Jadwal.php
├── Curhat.php
└── CurhatBalasan.php

Views/mahasiswa/
├── main.blade.php (Dashboard)
├── kelas.blade.php (Daftar Kelas)
├── kelas-detail.blade.php (Detail Kelas)
├── DaftarTugas.blade.php (Daftar Tugas)
├── tugas-detail.blade.php (Detail Tugas + Submit)
├── nilai.blade.php (Daftar Nilai)
├── CurhatVokasi.blade.php (Forum Curhat)
├── curhat-create.blade.php (Buat Curhat)
└── curhat-detail.blade.php (Detail Curhat)

Database/
├── migrations/ (8 migration files)
└── seeders/DatabaseSeeder.php (Dummy data)
```

## 🗄️ Database Schema

### users
- id, name, email, password, timestamps

### kelas
- id, nama_kelas, kode_kelas, deskripsi, instruktur_id, timestamps

### kelas_mahasiswa (Pivot)
- id, kelas_id, mahasiswa_id, timestamps

### tugas
- id, kelas_id, judul_tugas, deskripsi, tanggal_mulai, tanggal_deadline, file_materi, timestamps

### submissions
- id, tugas_id, mahasiswa_id, file_submission, status, tanggal_submit, timestamps

### nilais
- id, tugas_id, mahasiswa_id, nilai, feedback, timestamps

### jadwals
- id, kelas_id, hari, jam_mulai, jam_selesai, ruangan, timestamps

### curhats
- id, mahasiswa_id, judul, isi, kategori, timestamps

### curhat_balasans
- id, curhat_id, user_id, isi_balasan, timestamps

## 🔗 Routes (Protected with Auth Middleware)

```
GET  /                              → Dashboard
GET  /kelas                        → Daftar Kelas
GET  /kelas/{id}                   → Detail Kelas
GET  /DaftarTugas                  → Daftar Tugas
GET  /tugas/{id}                   → Detail Tugas
POST /tugas/{id}/submit            → Submit Tugas
GET  /nilai                        → Daftar Nilai
GET  /CurhatVokasi                 → Forum Curhat
GET  /curhat/create                → Form Buat Curhat
POST /curhat                       → Store Curhat
GET  /curhat/{id}                  → Detail Curhat
POST /curhat/{id}/balasan          → Store Balasan
```

## 📦 Model Relationships

```
User
├── has many Kelas (as instruktur_id)
├── belong to many Kelas (pivot: kelas_mahasiswa)
├── has many Submission
├── has many Nilai
├── has many Curhat
└── has many CurhatBalasan

Kelas
├── belongs to User (instruktur)
├── has many User (mahasiswas)
├── has many Tugas
└── has many Jadwal

Tugas
├── belongs to Kelas
├── has many Submission
└── has many Nilai

Submission
├── belongs to Tugas
└── belongs to User (mahasiswa)

Nilai
├── belongs to Tugas
└── belongs to User (mahasiswa)

Jadwal
└── belongs to Kelas

Curhat
├── belongs to User (mahasiswa)
└── has many CurhatBalasan

CurhatBalasan
├── belongs to Curhat
└── belongs to User
```

## 🛠️ Tech Stack

- **Framework**: Laravel 11
- **Database**: MySQL/SQLite
- **Frontend**: Blade Templates + Tailwind CSS
- **Authentication**: Laravel Auth

---

Semua backend sudah siap! Tinggal run `php artisan migrate --seed` dan `php artisan serve` 🚀
