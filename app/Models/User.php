<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'foto_profil',
        'google_id', // Tambahkan ini
        'telegram_chat_id', // Tambahkan ini
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

    public function tasklists():HasMany{
        return $this->hasMany(Tasklist::class);
    }

    public function categories():HasMany{
        return $this->hasMany(category::class);
    }

    public function catatans():HasMany{
        return $this->hasMany(catatan::class);
    }

    public function kegiatans():HasMany{
        return $this->hasMany(Kegiatan::class);
    }

    // Accessor Pintar (Hybrid)
public function getAvatarUrlAttribute()
{
    // 1. Cek apakah foto adalah link dari Google (http/https)
    if ($this->foto_profil && str_starts_with($this->foto_profil, 'http')) {
        return $this->foto_profil;
    }

    // 2. Cek apakah foto ada di storage lokal (hasil upload manual)
    if ($this->foto_profil && Storage::disk('public')->exists($this->foto_profil)) {
        return Storage::url($this->foto_profil);
    }

    // 3. Fallback ke UI Avatars jika tidak ada foto
    return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=CFF4E1&color=2E9A62&size=128';
}
}
