<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Posisi extends Model
{
    protected $fillable = ['id_mapel','nama_posisi'];

    public function mata_pelajaran(): BelongsTo
    {
        return $this->belongsTo(mata_pelajaran::class, 'id_mapel');
    }
    public function anggota_kelompok()
    {
        return $this->hasMany(anggota_kelompok::class, 'id_posisi');
    }
}
