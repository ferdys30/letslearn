<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class studi_kasus extends Model
{
    protected $table ='studi_kasus';
    protected $fillable = ['id_mapel','id_kelompok_pjbl','studi_kasus'];

    public function Mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class,'id_mapel');
    }
    public function kelompok_pjbl(): BelongsTo
    {
        return $this->belongsTo(kelompok_pjbl::class, 'id_kelompok_pjbl');
    }

}
