<?php

namespace App\Helper;

class CacheKeyNameHelper
{
    public const CACHE_KEY_NAME_PROVIDER_LOCATION_TMP = 'provider_location_tmp';

    public static function getProviderLocationTmpKeyName(string $providerName, string $location): string
    {
        return sprintf('%s_%s_%s', self::CACHE_KEY_NAME_PROVIDER_LOCATION_TMP, $providerName, $location);
    }
}