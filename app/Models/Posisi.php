<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Posisi extends Model
{
    public function posisi(): BelongsTo
    {
        return $this->belongsTo(posisi::class,'id_posisi');
    }
}
