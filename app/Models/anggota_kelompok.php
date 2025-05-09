<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class anggota_kelompok extends Model
{
    protected $fillable = ['id_kelompok','id_user'];

    public function kelompok(): BelongsTo
    {
        return $this->belongsTo(kelompok::class,'id_kelompok');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'id_user');
    }
}
