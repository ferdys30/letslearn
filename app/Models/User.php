<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $with= ['mata_pelajaran','anggota_kelompok','diskusi','pengumpulan','penilaian'];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nis','nip','nama','foto','jurusan','kelas','alamat',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mata_pelajaran(): HasMany
    {
        return $this->hasMany(mata_pelajaran::class, 'id_user');
    }

    public function anggota_kelompok(): HasOne
    {
        return $this->hasOne(anggota_kelompok::class, 'id_user');
    }

    public function diskusi(): HasMany
    {
        return $this->hasMany(diskusi::class,'id_user');
    }

    public function pengumpulan(): HasMany
    {
        return $this->hasMany(pengumpulan::class,'id_user');
    }

    public function penilaian(): HasMany
    {
        return $this->hasMany(penilaian::class,'id_user');
    }
}