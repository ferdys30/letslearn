<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tujuan_pembelajaran extends Model
{
    protected $table = 'tujuan_pembelajarans';

    protected $fillable = ['id_mapel','tujuan_pembelajaran'];


    public function mata_pelajaran(): BelongsTo
    {
        return $this->belongsTo(mata_pelajaran::class,'id_mapel');
    }
}
