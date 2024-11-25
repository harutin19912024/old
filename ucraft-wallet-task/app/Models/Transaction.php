<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Interfaces\MathService;
use App\Services\CastService;

/**
 * Class Transaction.
 *
 * @property string      $user_type
 * @property int|string  $user_id
 * @property int         $wallet_id
 * @property string      $uuid
 * @property string      $type
 * @property string      $amount
 * @property int         $amountInt
 * @property string      $amountFloat
 * @property bool        $confirmed
 * @property array       $meta
 * @property Wallet      $payable
 * @property WalletModel $wallet
 *
 * @method int getKey()
 */
class Transaction extends Model
{
    public const TYPE_DEPOSIT = 'deposit';

    public const TYPE_WITHDRAW = 'withdraw';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_type',
        'user_id',
        'wallet_id',
        'uuid',
        'type',
        'amount',
        'confirmed',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'wallet_id' => 'int',
        'confirmed' => 'bool'
    ];

    public function getTable(): string
    {
        return $this->table;
    }

    public function user(): MorphTo
    {
        return $this->morphTo();
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function getAmountIntAttribute(): int
    {
        return (int) $this->amount;
    }

    public function getAmountFloatAttribute(): string
    {
        $math = app(MathService::class);
        $decimalPlacesValue = app(CastService::class)
            ->getWallet($this->wallet)
            ->decimal_places;
        $decimalPlaces = $math->powTen($decimalPlacesValue);

        return $math->div($this->amount, $decimalPlaces, $decimalPlacesValue);
    }

    public function setAmountFloatAttribute(float|int|string $amount): void
    {
        $math = app(MathService::class);
        $decimalPlacesValue = app(CastService::class)
            ->getWallet($this->wallet)
            ->decimal_places;
        $decimalPlaces = $math->powTen($decimalPlacesValue);

        $this->amount = $math->round($math->mul($amount, $decimalPlaces));
    }
}
