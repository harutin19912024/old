<?php

namespace App\Interface\Query;

interface TransferQueryInterface
{
    /**
     * @return non-empty-array<int|string, string>
     */
    public function getUuids(): array;
}
