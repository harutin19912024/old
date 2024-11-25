<?php

namespace App\Services;

use App\Interfaces\Wallet;
use App\Interfaces\TransactionDtoInterface;
use App\Interfaces\LockProviderNotFoundException;
use Illuminate\Database\RecordsNotFoundException;
use App\Models\Transaction;

/**
 * @internal
 */
final class TransactionService implements TransactionServiceInterface
{
    public function __construct(
        private RegulatorServiceInterface $regulatorService,
        private CastServiceInterface $castService
    ) {
    }

    /**
     * @throws LockProviderNotFoundException
     * @throws RecordNotFoundException
     */
    public function makeOne(
        Wallet $wallet,
        string $type,
        float|int|string $amount,
        ?array $meta,
        bool $confirmed = true
    ): Transaction {
        assert(in_array($type, [Transaction::TYPE_DEPOSIT, Transaction::TYPE_WITHDRAW], true));

        $dto = $type === Transaction::TYPE_DEPOSIT
            ? $this->prepareService->deposit($wallet, (string) $amount, $meta, $confirmed)
            : $this->prepareService->withdraw($wallet, (string) $amount, $meta, $confirmed);

        $transactions = $this->apply([
            $dto->getWalletId() => $wallet,
        ], [$dto]);

        return current($transactions);
    }

    /**
     * @param non-empty-array<int, Wallet> $wallets
     * @param non-empty-array<int, TransactionDtoInterface> $objects
     *
     * @throws LockProviderNotFoundException
     * @throws RecordNotFoundException
     *
     * @return non-empty-array<string, Transaction>
     */
    public function apply(array $wallets, array $objects): array
    {
        $transactions = $this->atmService->makeTransactions($objects); // q1
        $totals = $this->assistantService->getSums($objects);
        assert(count($objects) === count($transactions));

        foreach ($totals as $walletId => $total) {
            $wallet = $wallets[$walletId] ?? null;
            assert($wallet !== null);

            $object = $this->castService->getWallet($wallet);
            assert($object->getKey() === $walletId);

            $this->regulatorService->increase($object, $total);
        }

        foreach ($transactions as $transaction) {
            $this->dispatcherService->dispatch($this->transactionCreatedEventAssembler->create($transaction));
        }

        return $transactions;
    }
}
