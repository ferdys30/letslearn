<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class mata_pelajaran extends Model
{
    protected $table = 'mata_pelajarans';

    protected $fillable = ['id_user','nama_mapel','slug','deskripsi_mapel'];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tujuan_pembelajaran(): HasMany
    {
        return $this->hasMany(tujuan_pembelajaran::class,'id_mapel');
    }

    public function indikator_penilaian(): HasMany
    {
        return $this->hasMany(indikator_penilaian::class,'id_mapel');
    }

    public function studi_kasus(): HasMany
    {
        return $this->hasMany(studi_kasus::class,'id_mapel');
    }

    public function kelompok(): HasMany
    {
        return $this->hasMany(kelompok::class,'id_mapel');
    }

    public function pjbl(): HasMany
    {
        return $this->hasMany(pjbl::class,'id_mapel');
    }
}