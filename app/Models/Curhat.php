<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curhat extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'judul',
        'isi',
        'kategori',
        'image',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    public function balasan()
    {
        return $this->hasMany(CurhatBalasan::class, 'curhat_id');
    }
}
