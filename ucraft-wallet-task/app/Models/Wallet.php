<?php

namespace App\Models;

use App\Traits\HasWalletFloat;
use App\Traits\CanConfirm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\RecordsNotFoundException;
use App\Interfaces\TransactionFailedException;
use Illuminate\Support\Str;
use App\Interfaces\WalletFloat;
use App\Services\RegulatorService;
use App\Interfaces\UuidFactoryService;
use App\Interfaces\MathService;
use App\Interfaces\ExceptionInterface;
use App\Services\AtomicService;

/**
 * Class Wallet.
 *
 * @property string                          $users_type
 * @property int|string                      $users_id
 * @property string                          $name
 * @property string                          $slug
 * @property string                          $uuid
 * @property string                          $description
 * @property null|array                      $meta
 * @property int                             $decimal_places
 * @property \App\Interfaces\Wallet          $holder
 * @property string                          $credit
 * @property string                          $currency
 *
 * @method int getKey()
 */
class Wallet extends Model implements WalletFloat
{
    use CanConfirm;
    use HasWalletFloat;

    /**
     * @var string[]
     */
    protected $fillable = [
        'users_type',
        'users_id',
        'name',
        'type',
        'slug',
        'uuid',
        'description',
        'meta',
        'balance',
        'decimal_places',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'decimal_places' => 'int',
        'meta' => 'json',
    ];

    /**
     * @var array<string, int|string>
     */
    protected $attributes = [
        'balance' => 0,
        'decimal_places' => 2,
    ];


    /**
     * Under ideal conditions, you will never need a method. Needed to deal with out-of-sync.
     *
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function refreshBalance(): bool
    {
        return app(AtomicService::class)->block($this, function () {
            $whatIs = $this->getBalanceAttribute();
            $balance = $this->getAvailableBalanceAttribute();
            if (app(MathService::class)->compare($whatIs, $balance) === 0) {
                return true;
            }

            return app(RegulatorService::class)->sync($this, $balance);
        });
    }

    public function getOriginalBalanceAttribute(): string
    {
        return (string)$this->getRawOriginal('balance', 0);
    }

    public function getAvailableBalanceAttribute(): float|int|string
    {
        return $this->walletTransactions()
            ->where('confirmed', true)
            ->sum('amount');
    }

    public function users(): MorphTo
    {
        return $this->morphTo();
    }

    public function getCurrencyAttribute(): string
    {
        return $this->meta['currency'] ?? Str::upper($this->slug);
    }

}
