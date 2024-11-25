<?php

namespace App\Services;

use App\Interfaces\Wallet;
use App\Interfaces\TransactionDtoInterface;
use App\Interfaces\LockProviderNotFoundException;
use Illuminate\Database\RecordsNotFoundException;
use App\Models\Transaction;

interface TransactionServiceInterface
{
    /**
     * @param null|array<mixed> $meta
     *
     * @throws LockProviderNotFoundException
     * @throws RecordNotFoundException
     */
    public function makeOne(
        Wallet $wallet,
        string $type,
        float|int|string $amount,
        ?array $meta,
        bool $confirmed = true
    ): Transaction;

    /**
     * @param non-empty-array<int, Wallet> $wallets
     * @param non-empty-array<int, TransactionDtoInterface> $objects
     *
     * @throws LockProviderNotFoundException
     * @throws RecordNotFoundException
     *
     * @return non-empty-array<string, Transaction>
     */
    public function apply(array $wallets, array $objects): array;
}
