<?php

namespace App\Service\Api\WeatherBit;

use App\Service\Api\CurrentWeather;

final class CurrentWeatherWeatherBitProvider extends CurrentWeather
{
    public const PROVIDER_NAME = 'weatherBit';

    public function __construct(private readonly WeatherBitClient $client, #[\SensitiveParameter] string $redisDSN)
    {
        parent::__construct($redisDSN);
    }

    protected function getCurrentWeather(float $lat, float $lon): float
    {
        $res = $this->client->get(
            sprintf('current?lat=%s&lon=%s', $lat, $lon)
        );

        return $res['data'][0]['temp'];
    }
}