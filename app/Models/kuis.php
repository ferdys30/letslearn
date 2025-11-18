<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kuis extends Model
{
    protected $table='kuis';
    protected $fillable = ['id_mapel','urutan_kuis','judul','deskripsi_kuis','waktu_pengerjaan'];

    public function Mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }

    public function penilaians(): HasMany
    {
        return $this->hasMany(Penilaian::class, 'id_kuis');
    }
    public function soals(): HasMany
    {
        return $this->hasMany(Soal::class, 'id_kuis');
    }
    
}
