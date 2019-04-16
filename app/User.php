<?php

namespace App;

use App\Entity\Shop\Cart;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

/**
 * @property mixed $cart
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $email_verified_at
 * @property \Carbon\Carbon $created_at
 */
class User extends Authenticatable
{
    use Notifiable;

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';

    public const ROLE_USER = 'user';
    public const ROLE_MODERATOR = 'moderator';
    public const ROLE_ADMIN = 'admin';

    
    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'status', 'role', 'verify_token', 'email_verified_at', 'remember_token'
    ];

    
    protected $hidden = [
        'password', 'remember_token'
    ];



    public static function rolesList(): array
    {
        return [
            self::ROLE_USER => 'User',
            self::ROLE_MODERATOR => 'Moderator',
            self::ROLE_ADMIN => 'Admin',
        ];
    }

    public static function statusList(): array
    {
        return [
            self::STATUS_WAIT => 'Disabled',
            self::STATUS_ACTIVE => 'Active',
        ];
    }

    //------------------- Корзина
    public function carts() {
        return $this->hasMany(Cart::class, 'user_id', 'id')->with('product');
    }

    public static function register(string $name, string $last_name, string $email, string $password): self
    {
        return static::create([
            'name' => $name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => bcrypt($password),
            'verify_token' => Str::uuid(),
            'remember_token' => Str::uuid(),
            'role' => self::ROLE_USER,
            'status' => self::STATUS_WAIT,
        ]);


    }

    public function verify(): void
    {
        if (!$this->isWait()) {
            throw new \DomainException('User is already verified. ( Пользователь верефицирован)');
        }

        $this->update([
            'status' => self::STATUS_ACTIVE,
            'verify_token' => null,
            'email_verified_at' => now(),
        ]);

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


    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isModerator(): bool
    {
        return $this->role === self::ROLE_MODERATOR;
    }
    

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }


    public function changeRole($role): void
    {
        if (!array_key_exists($role, self::rolesList())) {
            throw new \InvalidArgumentException('Undefined role "' . $role . '"');
        }
        if ($this->role === $role) {
            throw new \DomainException('Role is already assigned.');
        }
        $this->update(['role' => $role]);
    }


    public function changeStatus($status): void
    {
        if (!array_key_exists($status, self::statusList())) {
            throw new \InvalidArgumentException('Undefined status "' . $status . '"');
        }
        if ($this->status === $status) {
            throw new \DomainException('Status is already assigned.');
        }
        $this->update(['status' => $status]);
    }


    
    public function checkCartProduct($productId)
    {
        return auth()->user()->carts()->where('product_id', $productId)->first();
    }

}
