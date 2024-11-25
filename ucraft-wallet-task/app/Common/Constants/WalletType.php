<?php

namespace App\Common\Constants;

class WalletType
{
    public const WALLET_CREDIT_CARD = 'credit_card';

    public const WALLET_CACHE = 'cache';

    public const WALLET_TRAVEL = 'travel';

    /**
     * @return array
     */
    public static function getWalletTypes(): array
    {
        return [
            self::WALLET_CREDIT_CARD => __('Credit Card'),
            self::WALLET_CACHE => __('Cache'),
            self::WALLET_TRAVEL => __('Travel')
        ];
    }
}
