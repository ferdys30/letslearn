<?php

namespace App\Models;

use App\Models\Pjbl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class penugasan extends Model
{
    protected $fillable = ['id_mapel', 'judul', 'deskripsi'];

    public function mata_pelajaran(): BelongsTo
    {
        return $this->belongsTo(mata_pelajaran::class, 'id_mapel');
    }

    public function pjbls(): HasMany
    {
        return $this->hasMany(Pjbl::class, 'id_penugasan');
    }
}
