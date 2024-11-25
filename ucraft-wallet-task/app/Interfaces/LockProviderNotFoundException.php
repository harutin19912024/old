<?php

namespace App\Interfaces;

use UnexpectedValueException;

final class LockProviderNotFoundException extends UnexpectedValueException implements UnexpectedValueExceptionInterface
{
}
