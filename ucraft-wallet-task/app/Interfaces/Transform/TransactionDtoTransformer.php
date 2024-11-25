<?php

namespace App\Interface\Transform;

use App\Interfaces\TransactionDtoInterface;

final class TransactionDtoTransformer implements TransactionDtoTransformerInterface
{
    public function extract(TransactionDtoInterface $dto): array
    {
        return [
            'uuid' => $dto->getUuid(),
            'payable_type' => $dto->getPayableType(),
            'payable_id' => $dto->getPayableId(),
            'wallet_id' => $dto->getWalletId(),
            'type' => $dto->getType(),
            'amount' => $dto->getAmount(),
            'confirmed' => $dto->isConfirmed(),
            'meta' => $dto->getMeta(),
            'created_at' => $dto->getCreatedAt(),
            'updated_at' => $dto->getUpdatedAt(),
        ];
    }
}
