<?php

namespace App\Repository;

use App\Interfaces\TransferDtoInterface;
use App\Interface\Query\TransferQueryInterface;
use App\Models\Transfer;

interface TransferRepositoryInterface
{
    /**
     * @param non-empty-array<int|string, TransferDtoInterface> $objects
     */
    public function insert(array $objects): void;

    public function insertOne(TransferDtoInterface $dto): Transfer;

    /**
     * @return Transfer[]
     */
    public function findBy(TransferQueryInterface $query): array;

    /**
     * @param non-empty-array<int> $ids
     */
    public function updateStatusByIds(string $status, array $ids): int;
}
