<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class materi extends Model
{

    protected $fillable = [
        'id_mapel',
        'urutan_materi',
        'judul',
        'deskripsi_materi',
        'dokumen_materi',
    ];

    public function materi(): BelongsTo
    {
        return $this->belongsTo(mata_pelajaran::class,'id_mapel');
    }

}
