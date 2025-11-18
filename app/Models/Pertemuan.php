<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    protected $table ='pertemuans';
    protected $fillable = ['id_mapel','judul_pertemuan','tanggal'];
    public function aktivitas_pjbls()
    {
        return $this->hasMany(aktivitas_pjbl::class, 'id_pertemuan');
    }

}
