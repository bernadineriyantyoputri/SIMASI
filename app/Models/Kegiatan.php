<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'lokasi',
        'gambar',
        'kuota',
        'user_id',
    ];

    public function peserta()
    {
        return $this->hasMany(PesertaKegiatan::class, 'kegiatan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
