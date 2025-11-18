<?php

namespace App\Models;

use App\Models\kelompok_pjbl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class pengumpulan_tugas extends Model
{
    protected $table = 'pengumpulan_tugass'; // Tambahkan ini kalau perlu
     
    protected $fillable = ['id_kelompok_pjbl','id_user','id_siklus_pjbl','id_aktivitas_pjbl','deskriptif','file_pengumpulan_tugas','status','nilai'];

    public function kelompok_pjbl(): BelongsTo
    {
        return $this->belongsTo(kelompok_pjbl::class,'id_kelompok_pjbl');
    }
    public function aktivitas_pjbl(): BelongsTo
    {
        return $this->belongsTo(aktivitas_pjbl::class,'id_aktivitas_pjbl');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class,'id_user');
    }
}
