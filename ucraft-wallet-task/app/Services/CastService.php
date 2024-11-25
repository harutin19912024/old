<?php

namespace App\Services;

use App\Models\Wallet;
use App\Interfaces\ExceptionInterface;
use App\Models\Wallet as WalletModel;
use Illuminate\Database\Eloquent\Model;


/**
 * @internal
 */
final class CastService implements CastServiceInterface
{
    public function __construct() { }

    /**
     * @throws ExceptionInterface
     */
    public function getWallet(Wallet $object, bool $save = true): WalletModel
    {
        $wallet = $this->getModel($object);
        if (! ($wallet instanceof WalletModel)) {
            $wallet = $wallet->getAttribute('wallet');
            assert($wallet instanceof WalletModel);
        }

        return $wallet;
    }

    public function getHolder(Model|Wallet $object): Model
    {
        return $this->getModel($object instanceof WalletModel ? $object->users : $object);
    }

    public function getModel(object $object): Model
    {
        assert($object instanceof Model);

        return $object;
    }
}
