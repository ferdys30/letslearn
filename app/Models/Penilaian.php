<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penilaian extends Model
{

    protected $table = 'penilaians';
    
    protected $fillable = ['id_indikator','id_user','id_kuis','nilai','file_jawaban'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'id_user');
    }

    public function indikator(): BelongsTo
    {
        return $this->belongsTo(indikator_penilaian::class,'id_indikator');
    }
        // ✅ Relasi ke model Kuis
    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'id_kuis');
    }

    // ✅ Relasi ke model Siklus Pjbl
    public function siklusPjbl()
    {
        return $this->belongsTo(siklus_pjbl::class, 'id_siklus_pjbl');
    }

}
