<?php

namespace App\Interfaces;

use InvalidArgumentException;

final class TransactionRollbackException extends InvalidArgumentException implements ExceptionInterface
{
    public function __construct(
        private mixed $result
    ) {
        parent::__construct();
    }

    public function getResult(): mixed
    {
        return $this->result;
    }
}
