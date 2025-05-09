<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class diskusi extends Model
{
    protected $fillable = ['id_pjbl','id_kelompok','id_user','parent_id','pesan_diskusi'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'id_user');
    }
    public function kelompok(): BelongsTo
    {
        return $this->belongsTo(kelompok::class,'id_kelompok');
    }
    public function pjbl(): BelongsTo
    {
        return $this->belongsTo(pjbl::class,'id_pjbl');
    }
}
