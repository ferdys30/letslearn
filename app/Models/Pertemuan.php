<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    public function pjbls()
    {
        return $this->hasMany(Pjbl::class, 'id_pertemuan');
    }

}
