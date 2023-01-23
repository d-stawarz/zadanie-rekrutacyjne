<?php

namespace App\Service\Api\WeatherBit;

use App\Service\Api\CurrentWeatherInterface;

class CurrentWeatherWeatherBitProvider implements CurrentWeatherInterface
{
    public const PROVIDER_NAME = 'weatherBit';

    public function __construct(private readonly WeatherBitClient $client) { }

    public function getCurrentWeather(float $lat, float $lon): float
    {
        $res = $this->client->get(
            sprintf('current?lat=%s&lon=%s', $lat, $lon)
        );

        return $res['data'][0]['temp'];
    }

    public function getProviderName(): string
    {
        return self::PROVIDER_NAME;
    }
}