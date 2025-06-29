<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class indikator_penilaian extends Model
{

    protected $fillable = ['id_mapel','indikator_penilaian','skema','skala_1','skala_2','skala_3','skala_4','skala_5'];

    public function mata_pelajaran(): BelongsTo
    {
        return $this->belongsTo(mata_pelajaran::class,'id_mapel');
    }

    public function penilaian(): HasMany
    {
        return $this->hasMany(penilaian::class,'id_indikator');
    }
}

