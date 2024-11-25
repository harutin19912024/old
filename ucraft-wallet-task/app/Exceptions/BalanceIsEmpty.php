<?php

namespace App\Exceptions;

use App\Interfaces\LogicExceptionInterface;
use LogicException;

final class BalanceIsEmpty extends LogicException implements LogicExceptionInterface
{
}
