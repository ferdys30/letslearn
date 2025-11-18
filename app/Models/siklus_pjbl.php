<?php

namespace App\Models;

use App\Models\aktivitas_pjbl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class siklus_pjbl extends Model
{
    protected $table = 'siklus_pjbls';
    protected $fillable = ['id_mapel', 'nama_siklus_pjbl', 'slug', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function Mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }

    public function aktivitasPjbls(): HasMany
    {
        return $this->hasMany(aktivitas_pjbl::class, 'id_siklus_pjbl');
    }

    public function kelompok_pjbls(): HasMany
    {
        return $this->hasMany(kelompok_pjbl::class, 'id_siklus_pjbl');
    }
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'id_siklus_pjbl');
    }
}
