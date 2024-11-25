<?php

namespace App\Repository;

use App\Interfaces\TransactionDtoInterface;
use App\Interface\Query\TransactionQueryInterface;
use App\Interface\Transform\TransactionDtoTransformerInterface;
use App\Models\Transaction;

final class TransactionRepository implements TransactionRepositoryInterface
{
    public function __construct(
        private TransactionDtoTransformerInterface $transformer,
        private Transaction $transaction
    ) {
    }

    /**
     * @param non-empty-array<int|string, TransactionDtoInterface> $objects
     */
    public function insert(array $objects): void
    {
        $values = [];
        foreach ($objects as $object) {
            $values[] = array_map(
                fn ($value) => is_array($value) ? json_encode($value) : $value,
                $this->transformer->extract($object)
            );
        }

        $this->transaction->newQuery()
            ->insert($values)
        ;
    }

    public function insertOne(TransactionDtoInterface $dto): Transaction
    {
        $attributes = $this->transformer->extract($dto);
        $instance = $this->transaction->newInstance($attributes);
        $instance->saveQuietly();

        return $instance;
    }

    /**
     * @return Transaction[]
     */
    public function findBy(TransactionQueryInterface $query): array
    {
        return $this->transaction->newQuery()
            ->whereIn('uuid', $query->getUuids())
            ->get()
            ->all()
        ;
    }
}
