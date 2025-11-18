<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class indikator_penilaian extends Model
{

    protected $table ='indikator_penilaians';

    // protected $fillable = ['id_mapel','indikator_penilaian','id_siklus_pjbl','skema','id_posisi','nilai_maks','skala_1','skala_2','skala_3','skala_4','skala_5'];
    protected $fillable = ['id_mapel','indikator_penilaian','id_siklus_pjbl','skema','nilai_maks','skala_1','skala_2','skala_3','skala_4'];

    public function Mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class,'id_mapel');
    }

    public function penilaian(): HasMany
    {
        return $this->hasMany(penilaian::class,'id_indikator');
    }
    public function siklusPjbl()
{
    return $this->belongsTo(siklus_pjbl::class, 'id_siklus_pjbl');
}
    public function aktivitas_pjbl()
    {
        return $this->belongsTo(aktivitas_pjbl::class, 'id_aktivitas_pjbl');
    }

}

