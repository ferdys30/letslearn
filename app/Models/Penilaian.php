<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penilaian extends Model
{

    protected $fillable = ['id_indikator','id_user','nilai'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'id_user');
    }

    public function indikator_penilaian(): BelongsTo
    {
        return $this->belongsTo(indikator_penilaian::class,'id_indikator');
    }
}
