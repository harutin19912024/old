<?php

namespace App\Exceptions;

use App\Interfaces\InvalidArgumentExceptionInterface;
use InvalidArgumentException;

final class ConfirmedInvalid extends InvalidArgumentException implements InvalidArgumentExceptionInterface
{
}
