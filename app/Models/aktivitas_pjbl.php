<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class aktivitas_pjbl extends Model
{
    protected $table = 'aktivitas_pjbls'; // Tambahkan ini kalau perlu
    protected $fillable = ['urutan','id_mapel','id_siklus_pjbl','id_pertemuan','nama_syntax','slug','isi_syntax','penjelasan','pengumpulan_tugas','waktu','waktu_mulai'];

    public function Mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }

    public function diskusi(): HasMany
    {
        return $this->hasMany(diskusi::class);
    }

    public function pengumpulan_tugas(): HasMany
    {
        return $this->hasMany(pengumpulan_tugas::class);
    }
    public function siklus_pjbl(): BelongsTo
    {
        return $this->belongsTo(siklus_pjbl::class, 'id_siklus_pjbl');
    }
    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'id_aktivitas_pjbl');
    }
    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class, 'id_pertemuan');
    }

    public function studi_kasus()
    {
        return $this->belongsTo(studi_kasus::class, 'id_studi_kasus');
    }
    public function aktivitas_pjbl()
{
    return $this->belongsTo(\App\Models\aktivitas_pjbl::class, 'id_aktivitas_pjbl');
}


}
