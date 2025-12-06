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

    /**
     * Semua peserta yang mendaftar (pending, approved, rejected)
     */
    public function peserta()
    {
        return $this->hasMany(PesertaKegiatan::class, 'kegiatan_id');
    }

    /**
     * Peserta yang sudah disetujui admin
     */
    public function pesertaDisetujui()
    {
        return $this->hasMany(PesertaKegiatan::class, 'kegiatan_id')
                    ->where('status', 'approved');
    }

    /**
     * Relasi ke tabel absensi
     */
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'kegiatan_id');
    }
}
