<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class studi_kasus extends Model
{
    protected $fillable = ['id_mapel','id_kelompok','studi_kasus'];

    public function mata_pelajaran(): BelongsTo
    {
        return $this->belongsTo(mata_pelajaran::class,'id_mapel');
    }
    public function kelompok(): BelongsTo
    {
        return $this->belongsTo(kelompok::class, 'id_kelompok');
    }

}
