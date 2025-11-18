<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Soal extends Model
{
    protected $table= 'soals';
    protected $fillable = [
        'id_kuis',
        'urutan',
        'pertanyaan',
        'jawaban_a',
        'jawaban_b',
        'jawaban_c',
        'jawaban_d',
        'jawaban_e',
        'jawaban_benar',
        'point',
        'gambar',
    ];
    public function kuis(): BelongsTo
    {
        return $this->belongsTo(Kuis::class, 'id_kuis');
    }
}
