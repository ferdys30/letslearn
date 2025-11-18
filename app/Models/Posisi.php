<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Posisi extends Model
{
    protected $table ='posisis';
    protected $fillable = ['id_mapel','id_siklus_pjbl','nama_posisi'];

    public function Mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }
    public function anggota_kelompok()
    {
        return $this->hasMany(anggota_kelompok::class, 'id_posisi');
    }
}
