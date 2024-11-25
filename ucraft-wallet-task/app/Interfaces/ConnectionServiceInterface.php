<?php

namespace App\Interfaces;

use Illuminate\Database\ConnectionInterface;

interface ConnectionServiceInterface
{
    public function get(): ConnectionInterface;
}
