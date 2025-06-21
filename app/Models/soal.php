<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Soal extends Model
{
    public function kuis(): BelongsTo
    {
        return $this->belongsTo(Kuis::class, 'id_kuis');
    }
}
