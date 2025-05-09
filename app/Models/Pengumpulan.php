<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumpulan extends Model
{

    protected $fillable = ['id_kelompok','id_user','id_pjbl','deskriptif','file_pengumpulan'];

    public function kelompok(): BelongsTo
    {
        return $this->belongsTo(kelompok::class,'id_kelompok');
    }
    public function pjbl(): BelongsTo
    {
        return $this->belongsTo(pjbl::class,'id_pjbl');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class,'id_user');
    }
}
