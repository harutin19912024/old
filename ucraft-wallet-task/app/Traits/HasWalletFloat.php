<?php

namespace App\Traits;

use App\Exceptions\AmountInvalid;
use App\Exceptions\BalanceIsEmpty;
use App\Exceptions\InsufficientFunds;
use App\Interfaces\Wallet;
use App\Interfaces\ExceptionInterface;
use App\Interfaces\TransactionFailedException;
use App\Interfaces\MathServiceInterface;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Services\CastServiceInterface;
use Illuminate\Database\RecordsNotFoundException;

/**
 * Trait HasWalletFloat.
 *
 * @property string $balanceFloat
 * @property float  $balanceFloatNum
 * @psalm-require-extends \Illuminate\Database\Eloquent\Model
 * @psalm-require-implements \App\Interfaces\WalletFloat
 */
trait HasWalletFloat
{
    use HasWallet;

    /**
     * @throws AmountInvalid
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function forceWithdrawFloat(
        float|int|string $amount,
        ?array $meta = null,
        bool $confirmed = true
    ): Transaction {
        $math = app(MathServiceInterface::class);
        $decimalPlacesValue = app(CastServiceInterface::class)->getWallet($this)->decimal_places;
        $decimalPlaces = $math->powTen($decimalPlacesValue);
        $result = $math->round($math->mul($amount, $decimalPlaces, $decimalPlacesValue));

        return $this->forceWithdraw($result, $meta, $confirmed);
    }

    /**
     * @throws AmountInvalid
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function depositFloat(float|int|string $amount, ?array $meta = null, bool $confirmed = true): Transaction
    {
        $math = app(MathServiceInterface::class);
        $decimalPlacesValue = app(CastServiceInterface::class)->getWallet($this)->decimal_places;
        $decimalPlaces = $math->powTen($decimalPlacesValue);
        $result = $math->round($math->mul($amount, $decimalPlaces, $decimalPlacesValue));

        return $this->deposit($result, $meta, $confirmed);
    }

    /**
     * @throws AmountInvalid
     * @throws BalanceIsEmpty
     * @throws InsufficientFunds
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function withdrawFloat(float|int|string $amount, ?array $meta = null, bool $confirmed = true): Transaction
    {
        $math = app(MathServiceInterface::class);
        $decimalPlacesValue = app(CastServiceInterface::class)->getWallet($this)->decimal_places;
        $decimalPlaces = $math->powTen($decimalPlacesValue);
        $result = $math->round($math->mul($amount, $decimalPlaces, $decimalPlacesValue));

        return $this->withdraw($result, $meta, $confirmed);
    }

    public function canWithdrawFloat(float|int|string $amount): bool
    {
        $math = app(MathServiceInterface::class);
        $decimalPlacesValue = app(CastServiceInterface::class)->getWallet($this)->decimal_places;
        $decimalPlaces = $math->powTen($decimalPlacesValue);
        $result = $math->round($math->mul($amount, $decimalPlaces, $decimalPlacesValue));

        return $this->canWithdraw($result);
    }

    /**
     * @throws AmountInvalid
     * @throws BalanceIsEmpty
     * @throws InsufficientFunds
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function transferFloat(
        Wallet $wallet,
        float|int|string $amount
    ): Transfer {
        $math = app(MathServiceInterface::class);
        $decimalPlacesValue = app(CastServiceInterface::class)->getWallet($this)->decimal_places;
        $decimalPlaces = $math->powTen($decimalPlacesValue);
        $result = $math->round($math->mul($amount, $decimalPlaces, $decimalPlacesValue));

        return $this->transfer($wallet, $result);
    }

    public function safeTransferFloat(
        Wallet $wallet,
        float|int|string $amount
    ): ?Transfer {
        $math = app(MathServiceInterface::class);
        $decimalPlacesValue = app(CastServiceInterface::class)->getWallet($this)->decimal_places;
        $decimalPlaces = $math->powTen($decimalPlacesValue);
        $result = $math->round($math->mul($amount, $decimalPlaces, $decimalPlacesValue));

        return $this->safeTransfer($wallet, $result);
    }

    /**
     * @throws AmountInvalid
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function forceTransferFloat(
        Wallet $wallet,
        float|int|string $amount
    ): Transfer {
        $math = app(MathServiceInterface::class);
        $decimalPlacesValue = app(CastServiceInterface::class)->getWallet($this)->decimal_places;
        $decimalPlaces = $math->powTen($decimalPlacesValue);
        $result = $math->round($math->mul($amount, $decimalPlaces, $decimalPlacesValue));

        return $this->forceTransfer($wallet, $result);
    }

    public function getBalanceFloatAttribute(): string
    {
        $math = app(MathServiceInterface::class);
        $wallet = app(CastServiceInterface::class)->getWallet($this);
        $decimalPlacesValue = $wallet->decimal_places;
        $decimalPlaces = $math->powTen($decimalPlacesValue);

        return $math->div($wallet->getBalanceAttribute(), $decimalPlaces, $decimalPlacesValue);
    }

    public function getBalanceFloatNumAttribute(): float
    {
        return (float) $this->getBalanceFloatAttribute();
    }
}
