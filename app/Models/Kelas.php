<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table ='kelas';
    protected $fillable =['Kelas'];

    public function users() {
        return $this->hasMany(User::class, 'id_kelas');
    }
}
