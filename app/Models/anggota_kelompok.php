<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class anggota_kelompok extends Model
{
    protected $table ='anggota_kelompok';
    protected $fillable = ['id_kelompok_pjbl','id_user','id_posisi'];

    public function kelompok_pjbl(): BelongsTo
    {
        return $this->belongsTo(kelompok_pjbl::class,'id_kelompok_pjbl');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'id_user');
    }
    public function posisi()
    {
        return $this->belongsTo(Posisi::class, 'id_posisi');
    }
    public function indikator() {
        return $this->hasMany(indikator_penilaian::class, 'id_posisi', 'id_posisi');
    }
    public function tugas()
{
    return $this->hasMany(\App\Models\Tugas::class, 'id_anggota_kelompok');
}
}
