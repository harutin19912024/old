<?php

namespace App\Interface\Transform;

use App\Interfaces\TransactionDtoInterface;
use DateTimeImmutable;

interface TransactionDtoTransformerInterface
{
    /**
     * @return array{
     *     uuid: string,
     *     payable_type: string,
     *     payable_id: int|string,
     *     wallet_id: int,
     *     type: string,
     *     amount: float|int|string,
     *     confirmed: bool,
     *     meta: array<mixed>|null,
     *     created_at: DateTimeImmutable,
     *     updated_at: DateTimeImmutable,
     * }
     */
    public function extract(TransactionDtoInterface $dto): array;
}
