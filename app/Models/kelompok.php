<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class kelompok extends Model
{
    protected $fillable = ['id_mapel','nama_kelompok','jumlah_kelompok'];

    public function mata_pelajaran(): BelongsTo
    {
        return $this->belongsTo(mata_pelajaran::class,'id_mapel');
    }

    public function anggota_kelompok(): HasMany
    {
        return $this->hasMany(anggota_kelompok::class,'id_kelompok');
    }

    public function diskusi(): HasMany
    {
        return $this->hasMany(diskusi::class,'id_kelompok');
    }

    public function pengumpulan(): HasMany
    {
        return $this->hasMany(pengumpulan::class,'id_kelompok');
    }

    public function studi_kasus(): HasMany
    {
        return $this->hasMany(studi_kasus::class,'id_kelompok');
    }

     public function posisi(): BelongsTo
    {
        return $this->belongsTo(Posisi::class, 'id_posisi');
    }

    public function penugasan() {
        return $this->belongsTo(Penugasan::class, 'id_penugasan');
    }
}