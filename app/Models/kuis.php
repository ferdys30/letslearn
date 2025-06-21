<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kuis extends Model
{
    public function soals(): HasMany
    {
        return $this->hasMany(Soal::class, 'id_kuis');
    }
}
