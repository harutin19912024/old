<?php

namespace App\Interfaces;

use App\Exceptions\AmountInvalid;
use App\Exceptions\BalanceIsEmpty;
use App\Exceptions\InsufficientFunds;
use App\Interfaces\ExceptionInterface;
use App\Interfaces\TransactionFailedException;
use App\Models\Transaction;
use App\Models\Transfer;
use Illuminate\Database\RecordsNotFoundException;

interface WalletFloat
{
    /**
     * @param null|array<mixed> $meta
     *
     * @throws AmountInvalid
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function depositFloat(float|int|string $amount, ?array $meta = null, bool $confirmed = true): Transaction;

    /**
     * @param null|array<mixed> $meta
     *
     * @throws AmountInvalid
     * @throws BalanceIsEmpty
     * @throws InsufficientFunds
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function withdrawFloat(float|int|string $amount, ?array $meta = null, bool $confirmed = true): Transaction;

    /**
     * @param null|array<mixed> $meta
     *
     * @throws AmountInvalid
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function forceWithdrawFloat(
        float|int|string $amount,
        ?array $meta = null,
        bool $confirmed = true
    ): Transaction;

    /**
     * @param Wallet $wallet
     * @param float|int|string $amount
     * @return Transfer
     */
    public function transferFloat(
        Wallet $wallet,
        float|int|string $amount
    ): Transfer;

    /**
     * @param Wallet $wallet
     * @param float|int|string $amount
     * @return Transfer|null
     */
    public function safeTransferFloat(
        Wallet $wallet,
        float|int|string $amount
    ): ?Transfer;

    /**
     * @throws AmountInvalid
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function forceTransferFloat(
        Wallet $wallet,
        float|int|string $amount
    ): Transfer;

    public function canWithdrawFloat(float|int|string $amount): bool;

    public function getBalanceFloatAttribute(): string;

    public function getBalanceFloatNumAttribute(): float;
}
