<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{

    protected $fillable = [
        'judul',
        'deskripsi',
        'deadline',
        'id_pjbl',
        'id_penugasan',
        'id_anggota_kelompok',
    ];

    public function pjbl()
    {
        return $this->belongsTo(pjbl::class, 'id_pjbl');
    }
    public function anggota()
    {
        return $this->belongsTo(anggota_kelompok::class, 'id_anggota_kelompok');
    }
}