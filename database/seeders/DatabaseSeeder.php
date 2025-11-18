<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\Jadwal;
use App\Models\Submission;
use App\Models\Nilai;
use App\Models\Curhat;
use App\Models\CurhatBalasan;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create users (guru/instruktur)
        $instruktur1 = User::create([
            'name' => 'Bapak Andi',
            'email' => 'andi@example.com',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        $instruktur2 = User::create([
            'name' => 'Ibu Sari',
            'email' => 'sari@example.com',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        $instruktur3 = User::create([
            'name' => 'Pak Budi',
            'email' => 'budi@example.com',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        $mahasiswa1 = User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'ahmad@example.com',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
        ]);

        $mahasiswa2 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
        ]);

        $mahasiswa3 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budisantoso@example.com',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
        ]);

        // Create kelas
        $kelas1 = Kelas::create([
            'nama_kelas' => 'Pemrograman Web',
            'kode_kelas' => 'CS101',
            'deskripsi' => 'Pelajari dasar-dasar pemrograman web dengan HTML, CSS, dan JavaScript',
            'instruktur_id' => $instruktur1->id,
        ]);

        $kelas2 = Kelas::create([
            'nama_kelas' => 'Basis Data',
            'kode_kelas' => 'CS201',
            'deskripsi' => 'Pelajari desain dan implementasi database relasional',
            'instruktur_id' => $instruktur2->id,
        ]);

        $kelas3 = Kelas::create([
            'nama_kelas' => 'Internet of Things',
            'kode_kelas' => 'CS301',
            'deskripsi' => 'Pelajari konsep dan implementasi IoT',
            'instruktur_id' => $instruktur3->id,
        ]);

        // Attach mahasiswa to kelas
        $kelas1->mahasiswas()->attach([$mahasiswa1->id, $mahasiswa2->id, $mahasiswa3->id]);
        $kelas2->mahasiswas()->attach([$mahasiswa1->id, $mahasiswa2->id]);
        $kelas3->mahasiswas()->attach([$mahasiswa1->id, $mahasiswa3->id]);

        // Create jadwal
        Jadwal::create([
            'kelas_id' => $kelas1->id,
            'hari' => 'Senin',
            'jam_mulai' => '09:00',
            'jam_selesai' => '11:00',
            'ruangan' => 'Lab Komputer 1',
        ]);

        Jadwal::create([
            'kelas_id' => $kelas1->id,
            'hari' => 'Rabu',
            'jam_mulai' => '13:00',
            'jam_selesai' => '15:00',
            'ruangan' => 'Lab Komputer 1',
        ]);

        Jadwal::create([
            'kelas_id' => $kelas2->id,
            'hari' => 'Selasa',
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:00',
            'ruangan' => 'Ruang 101',
        ]);

        Jadwal::create([
            'kelas_id' => $kelas3->id,
            'hari' => 'Kamis',
            'jam_mulai' => '10:00',
            'jam_selesai' => '12:00',
            'ruangan' => 'Lab IoT',
        ]);

        // Create tugas
        $tugas1 = Tugas::create([
            'kelas_id' => $kelas1->id,
            'judul_tugas' => 'Membuat Form Login dengan HTML & CSS',
            'deskripsi' => 'Buatlah form login yang responsif dengan HTML5 dan CSS3. Form harus memiliki validasi input dasar.',
            'tanggal_mulai' => now()->subDays(5),
            'tanggal_deadline' => now()->addDays(5),
        ]);

        $tugas2 = Tugas::create([
            'kelas_id' => $kelas1->id,
            'judul_tugas' => 'Implementasi JavaScript interaktif',
            'deskripsi' => 'Buat halaman web dengan fitur JavaScript seperti modal, dropdown, dan form validation.',
            'tanggal_mulai' => now()->subDays(3),
            'tanggal_deadline' => now()->addDays(10),
        ]);

        $tugas3 = Tugas::create([
            'kelas_id' => $kelas2->id,
            'judul_tugas' => 'Desain Database Toko Online',
            'deskripsi' => 'Desain database untuk aplikasi toko online dengan table produk, user, pesanan, dan pembayaran.',
            'tanggal_mulai' => now()->subDays(7),
            'tanggal_deadline' => now()->addDays(3),
        ]);

        $tugas4 = Tugas::create([
            'kelas_id' => $kelas3->id,
            'judul_tugas' => 'Setup Arduino Sensor Suhu',
            'deskripsi' => 'Setup Arduino dengan sensor suhu DHT22 dan tampilkan data di serial monitor.',
            'tanggal_mulai' => now()->subDays(10),
            'tanggal_deadline' => now()->subDays(2),
        ]);

        // Create submissions
        Submission::create([
            'tugas_id' => $tugas1->id,
            'mahasiswa_id' => $mahasiswa1->id,
            'file_submission' => 'submissions/1/form-login.html',
            'status' => 'submitted',
            'tanggal_submit' => now()->subDays(2),
        ]);

        Submission::create([
            'tugas_id' => $tugas4->id,
            'mahasiswa_id' => $mahasiswa1->id,
            'file_submission' => 'submissions/4/arduino-code.ino',
            'status' => 'late',
            'tanggal_submit' => now()->addDays(1),
        ]);

        // Create nilai
        Nilai::create([
            'tugas_id' => $tugas1->id,
            'mahasiswa_id' => $mahasiswa1->id,
            'nilai' => 85,
            'feedback' => 'Form login sudah bagus, tapi perhatikan responsive design di mobile.',
        ]);

        Nilai::create([
            'tugas_id' => $tugas1->id,
            'mahasiswa_id' => $mahasiswa2->id,
            'nilai' => 90,
            'feedback' => 'Excellent! Form sangat rapi dan responsive.',
        ]);

        Nilai::create([
            'tugas_id' => $tugas4->id,
            'mahasiswa_id' => $mahasiswa1->id,
            'nilai' => 75,
            'feedback' => 'Terlambat, tapi kode sudah benar. Hati-hati deadline.',
        ]);

        // Create curhats
        $curhat1 = Curhat::create([
            'mahasiswa_id' => $mahasiswa1->id,
            'judul' => 'Kesulitan memahami JavaScript async/await',
            'isi' => 'Saya merasa kesulitan memahami konsep async/await di JavaScript. Bisakah ada yang menjelaskan dengan contoh yang lebih mudah?',
            'kategori' => 'Akademik',
        ]);

        $curhat2 = Curhat::create([
            'mahasiswa_id' => $mahasiswa2->id,
            'judul' => 'Tips menghadapi tugas programming yang banyak',
            'isi' => 'Semester ini tugas programming banyak banget. Bagaimana cara kalian manage waktu? Share tips dong!',
            'kategori' => 'Karir',
        ]);

        $curhat3 = Curhat::create([
            'mahasiswa_id' => $mahasiswa3->id,
            'judul' => 'Stress dengan tugas akhir semester',
            'isi' => 'Tugas akhir semester ini sangat menantang. Saya merasa cemas tidak bisa menyelesaikannya tepat waktu.',
            'kategori' => 'Pribadi',
        ]);

        // Create curhat balasan
        CurhatBalasan::create([
            'curhat_id' => $curhat1->id,
            'user_id' => $mahasiswa2->id,
            'isi_balasan' => 'Coba pelajari dari MDN docs, ada penjelasan yang bagus disana. Atau tonton video dari Traversy Media.',
        ]);

        CurhatBalasan::create([
            'curhat_id' => $curhat1->id,
            'user_id' => $instruktur1->id,
            'isi_balasan' => 'Async/await memang sulit dipahami di awalnya. Silakan minta bimbingan di jam konsultasi saya.',
        ]);

        CurhatBalasan::create([
            'curhat_id' => $curhat2->id,
            'user_id' => $mahasiswa1->id,
            'isi_balasan' => 'Saya biasa membuat todo list untuk setiap tugas dan kerjakan yang deadlinenya terdekat dulu.',
        ]);
    }
}