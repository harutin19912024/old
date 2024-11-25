<?php

namespace App\Interfaces;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\ConnectionResolverInterface;

/**
 * @internal
 */
final class ConnectionService implements ConnectionServiceInterface
{
    private ConnectionInterface $connection;

    public function __construct(ConnectionResolverInterface $connectionResolver)
    {
        $this->connection = $connectionResolver->connection(config('wallet.database.connection'));
    }

    public function get(): ConnectionInterface
    {
        return $this->connection;
    }
}
