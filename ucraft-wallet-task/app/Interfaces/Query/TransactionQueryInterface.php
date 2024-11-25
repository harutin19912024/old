<?php

namespace App\Interface\Query;

interface TransactionQueryInterface
{
    /**
     * @return non-empty-array<int|string, string>
     */
    public function getUuids(): array;
}
