<?php

namespace App\Traits;

use App\Exceptions\BalanceIsEmpty;
use App\Exceptions\ConfirmedInvalid;
use App\Exceptions\InsufficientFunds;
use App\Exceptions\WalletOwnerInvalid;
use App\Interfaces\ExceptionInterface;
use App\Interfaces\TransactionFailedException;
use App\Interfaces\MathServiceInterface;
use App\Models\Transaction;
use App\Services\AtomicServiceInterface;
use Illuminate\Database\RecordsNotFoundException;
use App\Services\CastServiceInterface;
use App\Services\ConsistencyServiceInterface;

/**
 * @psalm-require-extends \Illuminate\Database\Eloquent\Model
 */
trait CanConfirm
{
    /**
     * @throws BalanceIsEmpty
     * @throws InsufficientFunds
     * @throws ConfirmedInvalid
     * @throws WalletOwnerInvalid
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function confirm(Transaction $transaction): bool
    {
        return app(AtomicServiceInterface::class)->block($this, function () use ($transaction): bool {
            if ($transaction->type === Transaction::TYPE_WITHDRAW) {
                app(ConsistencyServiceInterface::class)->checkPotential(
                    app(CastServiceInterface::class)->getWallet($this),
                    app(MathServiceInterface::class)->negative($transaction->amount)
                );
            }

            return $this->forceConfirm($transaction);
        });
    }

    public function safeConfirm(Transaction $transaction): bool
    {
        try {
            return $this->confirm($transaction);
        } catch (ExceptionInterface) {
            return false;
        }
    }

    /**
     * Removal of confirmation (forced), use at your own peril and risk.
     *
     * @throws UnconfirmedInvalid
     * @throws WalletOwnerInvalid
     * @throws LockProviderNotFoundException
     * @throws RecordNotFoundException
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function resetConfirm(Transaction $transaction): bool
    {
        return app(AtomicServiceInterface::class)->block($this, function () use ($transaction) {
            if (! $transaction->confirmed) {
                throw new UnconfirmedInvalid(
                    app(TranslatorServiceInterface::class)->get('wallet::errors.unconfirmed_invalid'),
                    ExceptionInterface::UNCONFIRMED_INVALID
                );
            }

            $wallet = app(CastServiceInterface::class)->getWallet($this);
            if ($wallet->getKey() !== $transaction->wallet_id) {
                throw new WalletOwnerInvalid(
                    app(TranslatorServiceInterface::class)->get('wallet::errors.owner_invalid'),
                    ExceptionInterface::WALLET_OWNER_INVALID
                );
            }

            app(RegulatorServiceInterface::class)->decrease($wallet, $transaction->amount);

            return $transaction->update([
                'confirmed' => false,
            ]);
        });
    }

    public function safeResetConfirm(Transaction $transaction): bool
    {
        try {
            return $this->resetConfirm($transaction);
        } catch (ExceptionInterface) {
            return false;
        }
    }

    /**
     * @throws ConfirmedInvalid
     * @throws WalletOwnerInvalid
     * @throws LockProviderNotFoundException
     * @throws RecordNotFoundException
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function forceConfirm(Transaction $transaction): bool
    {
        return app(AtomicServiceInterface::class)->block($this, function () use ($transaction) {
            if ($transaction->confirmed) {
                throw new ConfirmedInvalid(
                    app(TranslatorServiceInterface::class)->get('wallet::errors.confirmed_invalid'),
                    ExceptionInterface::CONFIRMED_INVALID
                );
            }

            $wallet = app(CastServiceInterface::class)->getWallet($this);
            if ($wallet->getKey() !== $transaction->wallet_id) {
                throw new WalletOwnerInvalid(
                    app(TranslatorServiceInterface::class)->get('wallet::errors.owner_invalid'),
                    ExceptionInterface::WALLET_OWNER_INVALID
                );
            }

            app(RegulatorServiceInterface::class)->increase($wallet, $transaction->amount);

            return $transaction->update([
                'confirmed' => true,
            ]);
        });
    }
}
