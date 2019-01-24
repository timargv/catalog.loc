<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';

    public const ROLE_USER = 'user';
    public const ROLE_MODERATOR = 'moderator';
    public const ROLE_ADMIN = 'admin';

    
    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'status', 'role',
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function rolesList(): array
    {
        return [
            self::ROLE_USER => 'User',
            self::ROLE_MODERATOR => 'Moderator',
            self::ROLE_ADMIN => 'Admin',
        ];
    }


    public function isModerator(): bool
    {
        return $this->role === self::ROLE_MODERATOR;
    }
    

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }


    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }


    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }


    public static function new($name, $last_name, $email): self
    {
        return static::create([
            'name' => $name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => bcrypt(Str::random()),
            'role' => self::ROLE_USER,
            'status' => self::STATUS_ACTIVE,
        ]);
    }


}
