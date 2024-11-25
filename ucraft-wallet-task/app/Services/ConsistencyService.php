<?php

namespace App\Services;

use App\Exceptions\AmountInvalid;
use App\Exceptions\BalanceIsEmpty;
use App\Exceptions\InsufficientFunds;
use App\Interfaces\Wallet;
use App\Interfaces\ExceptionInterface;
use App\Interfaces\MathServiceInterface;

/**
 * @internal
 */
final class ConsistencyService implements ConsistencyServiceInterface
{
    public function __construct(
        private MathServiceInterface $mathService,
        private CastServiceInterface $castService
    ) {
    }

    /**
     * @throws AmountInvalid
     */
    public function checkPositive(float|int|string $amount): void
    {
        if ($this->mathService->compare($amount, 0) === -1) {
            throw new AmountInvalid(
                "Invalid Amount",
                ExceptionInterface::AMOUNT_INVALID
            );
        }
    }

    /**
     * @throws BalanceIsEmpty
     * @throws InsufficientFunds
     */
    public function checkPotential(Wallet $object, float|int|string $amount, bool $allowZero = false): void
    {
        $wallet = $this->castService->getWallet($object, false);
        $balance = $this->mathService->add($wallet->getBalanceAttribute(), $wallet->getCreditAttribute());

        if (($this->mathService->compare($amount, 0) !== 0) && ($this->mathService->compare($balance, 0) === 0)) {
            throw new BalanceIsEmpty(
                "Your Wallet Empty",
                ExceptionInterface::BALANCE_IS_EMPTY
            );
        }

        if (! $this->canWithdraw($balance, $amount, $allowZero)) {
            throw new InsufficientFunds(
                "Insufficient Funds",
                ExceptionInterface::INSUFFICIENT_FUNDS
            );
        }
    }

    public function canWithdraw(float|int|string $balance, float|int|string $amount, bool $allowZero = false): bool
    {
        $mathService = app(MathServiceInterface::class);

        /**
         * Allow buying for free with a negative balance.
         */
        if ($allowZero && ! $mathService->compare($amount, 0)) {
            return true;
        }

        return $mathService->compare($balance, $amount) >= 0;
    }
}
