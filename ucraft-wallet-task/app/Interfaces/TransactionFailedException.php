<?php

namespace App\Interfaces;

use LogicException;

final class TransactionFailedException extends LogicException implements LogicExceptionInterface
{
}
