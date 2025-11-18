<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class materi extends Model
{
    protected $table='materis';
    protected $fillable = ['id_mapel','urutan_materi','judul','deskripsi_materi','dokumen_materi'];


    public function Mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }

}
