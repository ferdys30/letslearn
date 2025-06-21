<?php

namespace App\Models;

use App\Models\kelompok;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengumpulan extends Model
{

    protected $fillable = ['id_kelompok','id_user','id_pjbl','deskriptif','file_pengumpulan','status'];

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
