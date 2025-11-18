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
    protected $table = 'users';
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'nis',
    'nip',
    'nama',
    'foto',
    'jurusan',
    'id_kelas',
    'paralel',
    'alamat',
    'email',
    'username',
    'password',
    'id_role', // ✅ Tambahkan ini!
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

    protected $casts = [
        'id_role' => 'integer',
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
    public function Mapel(): HasMany
    {
        return $this->hasMany(Mapel::class, 'id_user');
    }

    public function anggota_kelompok(): HasMany
    {
        return $this->hasMany(anggota_kelompok::class, 'id_user');
    }

    public function diskusi(): HasMany
    {
        return $this->hasMany(diskusi::class,'id_user');
    }

    public function pengumpulan_tugas(): HasMany
    {
        return $this->hasMany(pengumpulan_tugas::class,'id_user');
    }

    public function penilaians(): HasMany
    {
        return $this->hasMany(penilaian::class,'id_user');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}