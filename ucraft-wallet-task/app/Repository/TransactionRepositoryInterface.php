<?php

namespace App\Repository;

use App\Interfaces\TransactionDtoInterface;
use App\Interface\Query\TransactionQueryInterface;
use App\Models\Transaction;

interface TransactionRepositoryInterface
{
    /**
     * @param non-empty-array<int|string, TransactionDtoInterface> $objects
     */
    public function insert(array $objects): void;

    public function insertOne(TransactionDtoInterface $dto): Transaction;

    /**
     * @return Transaction[]
     */
    public function findBy(TransactionQueryInterface $query): array;
}
