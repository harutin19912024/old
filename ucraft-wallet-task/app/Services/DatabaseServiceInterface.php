<?php

namespace App\Services;

use App\Interfaces\ExceptionInterface;
use App\Interfaces\TransactionFailedException;
use Illuminate\Database\RecordsNotFoundException;

interface DatabaseServiceInterface
{
    /**
     * @template T
     * @param callable(): T $callback
     * @return T
     *
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function transaction(callable $callback): mixed;
}
