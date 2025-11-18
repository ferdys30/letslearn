<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class tujuan_pembelajaran extends Model
{
    protected $table = 'tujuan_pembelajarans';

    protected $fillable = ['id_mapel','tujuan_pembelajaran'];


    public function Mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class,'id_mapel');
    }
}
