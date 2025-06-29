<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pjbl extends Model
{
    protected $fillable = ['urutan','id_mapel','nama_syntax','slug','isi_syntax','penjelasan','pengumpulan','waktu','waktu_mulai'];

    public function mata_pelajaran(): BelongsTo
    {
        return $this->belongsTo(mata_pelajaran::class, 'id_mapel');
    }

    public function diskusi(): HasMany
    {
        return $this->hasMany(diskusi::class);
    }

    public function pengumpulan(): HasMany
    {
        return $this->hasMany(pengumpulan::class);
    }
    public function penugasan(): BelongsTo
    {
        return $this->belongsTo(Penugasan::class, 'id_penugasan');
    }
    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'id_pjbl');
    }
    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class, 'id_pertemuan');
    }

}
