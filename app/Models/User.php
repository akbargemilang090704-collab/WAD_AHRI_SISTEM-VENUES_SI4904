<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER  = 'user';
    public const ROLES      = [self::ROLE_ADMIN, self::ROLE_USER];

    protected $table = 'users';
    public $timestamps = false;

    protected $fillable = ['username', 'password', 'nama', 'role'];
    protected $hidden = ['password'];

    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    // Tabel users lama tidak punya kolom remember_token.
    public function getRememberTokenName()
    {
        return '';
    }
}
