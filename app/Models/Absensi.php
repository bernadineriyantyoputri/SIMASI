<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi'; // nama tabel di database
    protected $fillable = ['kegiatan_id', 'jumlah_peserta', 'tanggal', 'status'];
}
