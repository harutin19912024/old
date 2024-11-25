<?php

namespace App\Traits;

use App\Models\Wallet as WalletModel;
use App\Services\CastService;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Trait MorphOneWallet.
 *
 * @property WalletModel $wallet
 * @psalm-require-extends \Illuminate\Database\Eloquent\Model
 */
trait MorphOneWallet
{
    /**
     * Get default Wallet this method is used for Eager Loading.
     */
    public function wallet(): MorphOne
    {
        $castService = app(CastService::class);

        return $castService
            ->getHolder($this)
            ->morphOne(WalletModel::class, 'users')
            ->where('slug', 'amd')
            ->withDefault(static function (WalletModel $wallet, object $holder) use ($castService) {
                $model = $castService->getModel($holder);
                $wallet->forceFill(array_merge(config('wallet.creating', []), [
                    'name' => config('wallet.default.name', 'Default Wallet'),
                    'slug' => config('wallet.default.slug', 'default'),
                    'meta' => config('wallet.default.meta', []),
                    'balance' => 0,
                ]));

                if ($model->exists) {
                    $wallet->setRelation('holder', $model->withoutRelations());
                }
            })
        ;
    }

    public function getWalletAttribute(): ?WalletModel
    {
        /** @var WalletModel $wallet */
        $wallet = $this->getRelationValue('wallet');

        if (! $wallet->relationLoaded('users')) {
            $holder = app(CastService::class)->getHolder($this);
            $wallet->setRelation('holder', $holder->withoutRelations());
        }

        return $wallet;
    }
}
