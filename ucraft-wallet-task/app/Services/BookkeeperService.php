<?php

namespace App\Services;

use App\Interfaces\LockProviderNotFoundException;
use Illuminate\Database\RecordsNotFoundException;
use App\Interfaces\LockService;
use App\Interfaces\StorageService;
use App\Models\Wallet;

/**
 * @internal
 */
final class BookkeeperService implements BookkeeperServiceInterface
{
    public function __construct(
        private StorageService $storageService,
        private LockService $lockService
    ) {
    }

    public function missing(Wallet $wallet): bool
    {
        return $this->storageService->missing($wallet->uuid);
    }

    /**
     * @throws LockProviderNotFoundException
     * @throws RecordNotFoundException
     */
    public function amount(Wallet $wallet): string
    {
        return current($this->multiAmount([
            $wallet->uuid => $wallet,
        ]));
    }

    public function sync(Wallet $wallet, float|int|string $value): bool
    {
        return $this->multiSync([
            $wallet->uuid => $value,
        ]);
    }

    /**
     * @throws LockProviderNotFoundException
     * @throws RecordNotFoundException
     */
    public function increase(Wallet $wallet, float|int|string $value): string
    {
        return current($this->multiIncrease([
            $wallet->uuid => $wallet,
        ], [
            $wallet->uuid => $value,
        ]));
    }

    public function multiAmount(array $wallets): array
    {
        try {
            return $this->storageService->multiGet(array_keys($wallets));
        } catch (RecordNotFoundException $recordNotFoundException) {
            $this->lockService->blocks(
                $recordNotFoundException->getMissingKeys(),
                function () use ($wallets, $recordNotFoundException) {
                    $balances = [];
                    foreach ($recordNotFoundException->getMissingKeys() as $uuid) {
                        $balances[$uuid] = $wallets[$uuid]->getOriginalBalanceAttribute();
                    }

                    $this->multiSync($balances);
                }
            );
        }

        return $this->storageService->multiGet(array_keys($wallets));
    }

    public function multiSync(array $balances): bool
    {
        return $this->storageService->multiSync($balances);
    }

    public function multiIncrease(array $wallets, array $incrementValues): array
    {
        try {
            return $this->storageService->multiIncrease($incrementValues);
        } catch (RecordNotFoundException $recordNotFoundException) {
            $objects = [];
            foreach ($recordNotFoundException->getMissingKeys() as $uuid) {
                $objects[$uuid] = $wallets[$uuid];
            }

            $this->multiAmount($objects);
        }

        return $this->storageService->multiIncrease($incrementValues);
    }
}
