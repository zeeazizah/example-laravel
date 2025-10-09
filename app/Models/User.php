<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Konstanta Role
    const ADMIN = 1;
    const USER  = 2;

    /**
     * Kolom yang bisa diisi mass-assignment
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'photo',
        'role',
    ];

    /**
     * Kolom yang disembunyikan ketika serialisasi (misalnya ke JSON)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting kolom
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
	

    /**
     * Cek role
     */
    public function hasRole($role): bool
    {
        return $this->role == $role;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ADMIN;
    }

    public function isUser(): bool
    {
        return $this->role === self::USER;
    }

    /**
     * Relasi ke posts (1 user punya banyak post)
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
