<?php

namespace App\Services;

use App\Models\Wallet;
use App\Interfaces\ExceptionInterface;
use App\Interfaces\LockProviderNotFoundException;
use App\Interfaces\TransactionFailedException;
use App\Services\DatabaseService;
use Illuminate\Database\RecordsNotFoundException;
use App\Interfaces\LockService;

/**
 * @internal
 */
final class AtomicService implements AtomicServiceInterface
{
    public function __construct(
        private DatabaseService $databaseService,
        private LockService $lockService,
        private CastService $castService
    ) {
    }

    /**
     * @param non-empty-array<Wallet> $objects
     *
     * @throws LockProviderNotFoundException
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function blocks(array $objects, callable $callback): mixed
    {
        /** @var array<string, Wallet> $blockObjects */
        $blockObjects = [];
        foreach ($objects as $object) {
            $wallet = $this->castService->getWallet($object);
            if (! $this->lockService->isBlocked($wallet->uuid)) {
                $blockObjects[$wallet->uuid] = $wallet;
            }
        }

        if ($blockObjects === []) {
            return $callback();
        }

        $callable = function () use ($blockObjects, $callback) {
            $this->stateService->multiFork(
                array_keys($blockObjects),
                fn () => $this->bookkeeperService->multiAmount($blockObjects)
            );

            return $this->databaseService->transaction($callback);
        };

        try {
            return $this->lockService->blocks(array_keys($blockObjects), $callable);
        } finally {
            foreach (array_keys($blockObjects) as $uuid) {
                $this->stateService->drop($uuid);
            }
        }
    }

    /**
     * @throws LockProviderNotFoundException
     * @throws RecordsNotFoundException
     * @throws TransactionFailedException
     * @throws ExceptionInterface
     */
    public function block(Wallet $object, callable $callback): mixed
    {
        return $this->blocks([$object], $callback);
    }
}
