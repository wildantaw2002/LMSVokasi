<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'judul_tugas',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_deadline',
        'file_materi',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_deadline' => 'datetime',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
