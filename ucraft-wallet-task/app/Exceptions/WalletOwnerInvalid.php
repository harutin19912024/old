<?php

namespace App\Exceptions;

use App\Interfaces\InvalidArgumentExceptionInterface;
use InvalidArgumentException;

final class WalletOwnerInvalid extends InvalidArgumentException implements InvalidArgumentExceptionInterface
{
}
