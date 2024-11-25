<?php

namespace App\Exceptions;

use App\Interfaces\LogicExceptionInterface;
use LogicException;

final class InsufficientFunds extends LogicException implements LogicExceptionInterface
{
}
