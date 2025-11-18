<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class diskusi extends Model
{
    protected $fillable = ['id_aktivitas_pjbl','id_kelompok_pjbl','id_user','parent_id','pesan_diskusi'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'id_user');
    }
    public function kelompok_pjbl(): BelongsTo
    {
        return $this->belongsTo(kelompok_pjbl::class,'id_kelompok_pjbl');
    }
    public function aktivitas_pjbl(): BelongsTo
    {
        return $this->belongsTo(aktivitas_pjbl::class,'id_aktivitas_pjbl');
    }
}
