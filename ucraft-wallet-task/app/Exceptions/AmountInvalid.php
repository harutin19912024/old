<?php

namespace App\Exceptions;

use App\Interfaces\ExceptionInterface;
use InvalidArgumentException;

final class AmountInvalid extends InvalidArgumentException implements ExceptionInterface
{
}
