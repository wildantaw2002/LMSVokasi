# Backend LMS Vokasi - Setup & Run

Saya telah membuat backend lengkap untuk LMS Vokasi Anda. Berikut adalah ringkasannya.

## 📋 Apa yang Telah Dibuat

### 1. Models (Database Layer)
- ✅ `User` - Model pengguna (instruktur & mahasiswa)
- ✅ `Kelas` - Model kelas dengan relasi many-to-many ke mahasiswa
- ✅ `Tugas` - Model tugas per kelas
- ✅ `Submission` - Model pengumpulan tugas mahasiswa
- ✅ `Nilai` - Model nilai tugas mahasiswa
- ✅ `Jadwal` - Model jadwal kelas
- ✅ `Curhat` - Model forum curhat
- ✅ `CurhatBalasan` - Model balasan di forum

### 2. Controllers
- ✅ `MahasiswaController` - Dashboard utama
- ✅ `KelasController` - Kelola daftar kelas & detail kelas
- ✅ `TugasController` - Daftar tugas & submit tugas
- ✅ `NilaiController` - Daftar nilai mahasiswa
- ✅ `CurhatController` - Forum curhat & balasan

### 3. Routes
- ✅ `/` - Dashboard mahasiswa
- ✅ `/kelas` - Daftar kelas
- ✅ `/kelas/{id}` - Detail kelas
- ✅ `/DaftarTugas` - Daftar tugas
- ✅ `/tugas/{id}` - Detail tugas + submit
- ✅ `/nilai` - Daftar nilai
- ✅ `/CurhatVokasi` - Forum curhat
- ✅ `/curhat/create` - Buat curhat baru
- ✅ `/curhat/{id}` - Detail curhat + balasan

### 4. Views
- ✅ `mahasiswa/main.blade.php` - Dashboard
- ✅ `mahasiswa/kelas.blade.php` - Daftar kelas
- ✅ `mahasiswa/kelas-detail.blade.php` - Detail kelas
- ✅ `mahasiswa/DaftarTugas.blade.php` - Daftar tugas
- ✅ `mahasiswa/tugas-detail.blade.php` - Detail tugas & submit
- ✅ `mahasiswa/nilai.blade.php` - Daftar nilai
- ✅ `mahasiswa/CurhatVokasi.blade.php` - Forum curhat
- ✅ `mahasiswa/curhat-create.blade.php` - Buat curhat
- ✅ `mahasiswa/curhat-detail.blade.php` - Detail curhat

### 5. Database
- ✅ Migrations untuk semua tabel
- ✅ Seeders dengan data dummy

## 🚀 Cara Menjalankan

### 1. Install Dependencies (jika belum)
```bash
composer install
npm install
```

### 2. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Setup Database
```bash
# Jalankan migrations
php artisan migrate

# Seed data dummy
php artisan db:seed
```

### 4. Jalankan Server
```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

## 👤 Akun Test

Setelah menjalankan seeder, Anda bisa login dengan:

**Mahasiswa:**
- Email: `ahmad@example.com` / Password: `password`
- Email: `siti@example.com` / Password: `password`
- Email: `budisantoso@example.com` / Password: `password`

**Instruktur:**
- Email: `andi@example.com` / Password: `password`
- Email: `sari@example.com` / Password: `password`
- Email: `budi@example.com` / Password: `password`

## 📊 Fitur Utama

### Dashboard Mahasiswa
- Tampilkan kelas yang diambil
- Tampilkan tugas mendatang (5 tugas terdekat)
- Tampilkan nilai terbaru
- Quick links ke fitur lainnya

### Kelas
- Daftar kelas yang diambil mahasiswa
- Detail kelas dengan instruktur, jadwal, dan tugas
- Informasi mahasiswa di setiap kelas

### Tugas
- Daftar tugas yang belum dan sudah selesai
- Detail tugas dengan deskripsi, deadline
- Submit tugas dengan validasi file
- Lihat status submission (submitted/late/graded)
- Lihat nilai dan feedback dari instruktur

### Nilai
- Daftar semua nilai yang diperoleh
- Rata-rata nilai
- Filter dan sort

### Forum Curhat
- Buat curhat baru dengan kategori
- Lihat semua curhat dengan pagination
- Lihat detail curhat dan balasan
- Tambah balasan di setiap curhat
- Kategori: Akademik, Kesehatan, Karir, Pribadi, Teknis

## 🔒 Keamanan

- Semua route dilindungi dengan middleware `auth`
- Validasi akses: mahasiswa hanya bisa lihat kelas yang diambil
- File submission disimpan di `storage/submissions/`
- Password di-hash dengan bcrypt

## 📝 Catatan

- Middleware auth perlu dikonfigurasi di `bootstrap/providers.php` atau `config/auth.php`
- Untuk production, ganti dummy password dengan password yang kuat
- Setup CORS jika frontend terpisah dari backend
- Konfigurasi storage disk untuk file submissions

## 🎯 Langkah Selanjutnya (Optional)

1. **Buat API Routes** - Jika ingin pakai REST API
2. **Setup Authentication** - Login/register untuk mahasiswa baru
3. **Upload File** - Setup storage disk yang proper
4. **Validasi Lebih** - Tambah custom validation rules
5. **Testing** - Buat unit tests untuk business logic

---

Backend sudah siap digunakan! Silakan test semua fitur dengan akun yang tersedia.
