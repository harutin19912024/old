<?php

namespace App\Common\Constants;

class Currency
{
    public const WALLET_USD_CURRENCY = 'usd';

    public const WALLET_EUR_CURRENCY = 'eur';

    public const WALLET_AMD_CURRENCY = 'amd';

    /**
     * @return array
     */
    public static function getCurrencies(): array
    {
        return [
            self::WALLET_AMD_CURRENCY => __('AMD'),
            self::WALLET_EUR_CURRENCY => __('EUR'),
            self::WALLET_USD_CURRENCY => __('USD')
        ];
    }
}
