<?php

namespace App\Models;

use App\Models\Wallet;
use App\Traits\HasWallet;
use App\Traits\HasWallets;
use App\Traits\Metable;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use Metable;
    use HasWallet;
    use HasWallets;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'google_id',
        'facebook_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * method of obtaining all wallets.
     */
    public function wallets(): BelongsToMany
    {
        return $this->belongsToMany(Wallet::class, 'users_has_wallets', 'user_id', 'wallet_id');
    }

    /**
     * @return Attribute
     */
    public function name(): Attribute
    {
        return Attribute::make(
            get: fn() => "{$this->first_name} {$this->last_name}",
            set: function (?string $name) {
                $nameArr = explode(' ', $name ?? '');

                return [
                    'first_name' => $nameArr[0] ?? '',
                    'last_name' => $nameArr[1] ?? '',
                ];
            },
        );
    }

    public function total(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->orders->sum(fn(Order $order) => $order->total()),
        );
    }

    /**
     * @return int
     */
    public function getWalletsCount(): int
    {
        return 0;
    }
}
