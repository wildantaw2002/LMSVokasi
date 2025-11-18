<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurhatBalasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'curhat_id',
        'user_id',
        'isi_balasan',
    ];

    public function curhat()
    {
        return $this->belongsTo(Curhat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
