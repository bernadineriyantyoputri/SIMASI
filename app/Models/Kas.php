<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $fillable = [
        'tanggal',
        'jenis',
        'kategori',
        'keterangan',
        'nominal',
        'dicatat_oleh',
    ];
}

