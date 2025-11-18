<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table ='tugas';
    protected $fillable = [
        'judul',
        'deskripsi',
        'deadline',
        'id_aktivitas_pjbl',
        'id_siklus_pjbl',
        'id_anggota_kelompok',
    ];

    public function aktivitas_pjbl()
    {
        return $this->belongsTo(aktivitas_pjbl::class, 'id_aktivitas_pjbl');
    }
    public function anggota_kelompok()
    {
        return $this->belongsTo(anggota_kelompok::class, 'id_anggota_kelompok');
    }
    public function anggotaKelompok()
{
    return $this->belongsTo(\App\Models\anggota_kelompok::class, 'id_anggota_kelompok');
}
}