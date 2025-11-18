<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kelas',
        'kode_kelas',
        'deskripsi',
        'instruktur_id',
    ];

    public function instruktur()
    {
        return $this->belongsTo(User::class, 'instruktur_id');
    }

    public function mahasiswas()
    {
        return $this->belongsToMany(User::class, 'kelas_mahasiswa', 'kelas_id', 'mahasiswa_id');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}
