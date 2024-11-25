<?php

namespace App\Interfaces;


use App\Models\Transaction;
use App\Models\Transfer;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\RecordsNotFoundException;
use App\Exceptions\AmountInvalid;
use App\Exceptions\BalanceIsEmpty;
use App\Exceptions\InsufficientFunds;

interface Wallet
{
    /**
     * @param array<mixed>|null $meta
     *
     * @throws AmountInvalid
     * @throws LockProviderNotFoundException
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function deposit(int|string $amount, ?array $meta = null, bool $confirmed = true): Transaction;

    /**
     * @param array<mixed>|null $meta
     *
     * @throws AmountInvalid
     * @throws BalanceIsEmpty
     * @throws InsufficientFunds
     * @throws LockProviderNotFoundException
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function withdraw(int|string $amount, ?array $meta = null, bool $confirmed = true): Transaction;

    /**
     * @param array<mixed>|null $meta
     *
     * @throws AmountInvalid
     * @throws LockProviderNotFoundException
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function forceWithdraw(int|string $amount, ?array $meta = null, bool $confirmed = true): Transaction;

    /**
     *
     * @throws AmountInvalid
     * @throws BalanceIsEmpty
     * @throws InsufficientFunds
     * @throws LockProviderNotFoundException
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function transfer(self $wallet, int|string $amount): Transfer;

    /**
     * @param Wallet $wallet
     * @param int|string $amount
     * @return Transfer|null
     */
    public function safeTransfer(
        self $wallet,
        int|string $amount
    ): ?Transfer;

    /**
     *
     * @throws AmountInvalid
     * @throws LockProviderNotFoundException
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function forceTransfer(
        self $wallet,
        int|string $amount
    ): Transfer;

    public function canWithdraw(int|string $amount, bool $allowZero = false): bool;

    public function getBalanceAttribute(): string;

    public function getBalanceIntAttribute(): int;

    public function walletTransactions(): HasMany;

    public function transactions(): MorphMany;

    public function transfers(): MorphMany;
}
