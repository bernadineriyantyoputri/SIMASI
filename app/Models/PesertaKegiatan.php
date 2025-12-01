<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaKegiatan extends Model
{
    use HasFactory;

    // pakai nama tabel yang benar
    protected $table = 'peserta_kegiatan';

    protected $fillable = ['kegiatan_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
