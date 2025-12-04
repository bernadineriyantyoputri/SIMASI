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
        'kuota',
        'user_id',
        'gambar',
        'jam',
    ];

    // Relasi peserta yg SUDAH DISETUJUI (untuk hitung kuota)
    public function peserta()
    {
        return $this->hasMany(PesertaKegiatan::class, 'kegiatan_id')
                    ->where('status', 'approved');
    }

    // Kalau butuh semua peserta (pending + approved) di tempat lain
    public function semuaPeserta()
    {
        return $this->hasMany(PesertaKegiatan::class, 'kegiatan_id');
    }
}
