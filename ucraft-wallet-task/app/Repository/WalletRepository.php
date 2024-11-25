<?php

namespace App\Repository;

use App\Interfaces\ExceptionInterface;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\ModelNotFoundException as EloquentModelNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class WalletRepository implements WalletRepositoryInterface
{
    public function __construct(
        private Wallet $wallet
    ) {
    }

    public function create(array $attributes): Wallet
    {
        $instance = $this->wallet->newInstance($attributes);
        $instance->saveQuietly();

        return $instance;
    }

    /**
     * @param non-empty-array<int, string|float|int> $data
     */
    public function updateBalances(array $data): int
    {
        if (count($data) === 1) {
            return $this->wallet->newQuery()
                ->whereKey(key($data))
                ->update([
                    'balance' => current($data),
                ]);
        }

        $cases = [];
        foreach ($data as $walletId => $balance) {
            $cases[] = 'WHEN id = ' . $walletId . ' THEN ' . $balance;
        }

        $buildQuery = $this->wallet->getConnection()
            ->raw('CASE ' . implode(' ', $cases) . ' END');

        return $this->wallet->newQuery()
            ->whereIn('id', array_keys($data))
            ->update([
                'balance' => $buildQuery,
            ]);
    }

    public function findById(int $id): ?Wallet
    {
        try {
            return $this->getById($id);
        } catch (ModelNotFoundException) {
            return null;
        }
    }

    public function findByUuid(string $uuid): ?Wallet
    {
        try {
            return $this->getByUuid($uuid);
        } catch (ModelNotFoundException) {
            return null;
        }
    }

    public function findBySlug(string $holderType, int|string $holderId, string $slug): ?Wallet
    {
        try {
            return $this->getBySlug($holderType, $holderId, $slug);
        } catch (ModelNotFoundException) {
            return null;
        }
    }

    /**
     * @throws ModelNotFoundException
     */
    public function getById(int $id): Wallet
    {
        return $this->getBy([
            'id' => $id,
        ]);
    }

    /**
     * @throws ModelNotFoundException
     */
    public function getByUuid(string $uuid): Wallet
    {
        return $this->getBy([
            'uuid' => $uuid,
        ]);
    }

    /**
     * @throws ModelNotFoundException
     */
    public function getBySlug(string $usersType, int|string $usersId, string $slug): Wallet
    {
        return $this->getBy([
            'users_type' => $usersType,
            'users_id' => $usersId,
            'slug' => $slug,
        ]);
    }

    /**
     * @param array<int|string> $holderIds
     *
     * @return Wallet[]
     */
    public function findDefaultAll(string $usersType, array $usersIds): array
    {
        return $this->wallet->newQuery()
            ->where('slug', config('wallet.wallet.default.slug', 'default'))
            ->where('users_type', $usersType)
            ->whereIn('users_id', $usersIds)
            ->get()
            ->all()
        ;
    }

    /**
     * @param array<string, int|string> $attributes
     */
    private function getBy(array $attributes): Wallet
    {
        assert($attributes !== []);

        try {
            $wallet = $this->wallet->newQuery()
                ->where($attributes)
                ->firstOrFail()
            ;
            assert($wallet instanceof Wallet);

            return $wallet;
        } catch (EloquentModelNotFoundException $exception) {
            throw new ModelNotFoundException(
                $exception->getMessage(),
                ExceptionInterface::MODEL_NOT_FOUND,
                $exception
            );
        }
    }
}
