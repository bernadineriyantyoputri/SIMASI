<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaKegiatan extends Model
{
    protected $table = 'peserta_kegiatan';

    protected $fillable = [
        'user_id',
        'kegiatan_id'
    ];

    public function kegiatan()
    {
         return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
}
