<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Mapel extends Model
{
    protected $table = 'Mapels';

    protected $fillable = ['id_user', 'nama_mapel', 'slug', 'id_kelas', 'deskripsi_mapel'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user'); // pastikan ini
    }
    public function siswas()
    {
        return $this->hasMany(User::class, 'id_kelas', 'id_kelas')
            ->where('id_role', 3); // hanya siswa
    }
    public function kuis()
    {
        return $this->hasMany(Kuis::class, 'id_mapel');
    }

    public function siklusPjbl()
    {
        return $this->hasMany(siklus_pjbl::class, 'id_mapel');
    }


    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function tujuan_pembelajaran(): HasMany
    {
        return $this->hasMany(tujuan_pembelajaran::class, 'id_mapel');
    }

    public function materi(): HasMany
    {
        return $this->hasMany(materi::class, 'id_mapel');
    }

    public function indikator_penilaian(): HasMany
    {
        return $this->hasMany(indikator_penilaian::class, 'id_mapel');
    }

    public function studi_kasus(): HasMany
    {
        return $this->hasMany(studi_kasus::class, 'id_mapel');
    }

    public function kelompok_pjbl(): HasMany
    {
        return $this->hasMany(kelompok_pjbl::class, 'id_mapel');
    }
    public function kelompokPjbls(): HasMany
    {
        return $this->hasMany(kelompok_pjbl::class, 'id_mapel');
    }

    public function aktivitas_pjbls(): HasMany
    {
        return $this->hasMany(aktivitas_pjbl::class, 'id_mapel');
    }

    public function siklusPjbls()
    {
        return $this->hasMany(siklus_pjbl::class, 'id_mapel'); // asumsi 'id_mapel' adalah foreign key-nya
    }
}
