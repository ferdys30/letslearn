<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class kelompok_pjbl extends Model
{
    protected $table = 'kelompok_pjbl'; // 👈 WAJIB ditentukan
    protected $fillable = ['id_mapel','id_siklus_pjbl','id_kelas','paralel','nama_kelompok_pjbl','jumlah_kelompok_pjbl'];

    public function Mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class,'id_mapel');
    }

    public function anggota_kelompoks(): HasMany
    {
        return $this->hasMany(anggota_kelompok::class,'id_kelompok_pjbl');
    }
    
    public function anggota_kelompok(): HasMany
    {
        return $this->hasMany(anggota_kelompok::class,'id_kelompok_pjbl');
    }

    public function diskusi(): HasMany
    {
        return $this->hasMany(diskusi::class,'id_kelompok_pjbl');
    }

    public function pengumpulan_tugas(): HasMany
    {
        return $this->hasMany(pengumpulan_tugas::class,'id_kelompok_pjbl');
    }

    public function studi_kasus(): HasMany
    {
        return $this->hasMany(studi_kasus::class,'id_kelompok_pjbl');
    }

     public function posisi(): BelongsTo
    {
        return $this->belongsTo(Posisi::class, 'id_posisi');
    }

    public function siklus_pjbl() {
        return $this->belongsTo(siklus_pjbl::class, 'id_siklus_pjbl');
    }
}