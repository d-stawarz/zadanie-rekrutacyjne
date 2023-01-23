<?php

namespace App\Service\Api\OpenWeatherMap;

use App\Service\Api\CurrentWeatherInterface;

class CurrentWeatherOpenWeatherProvider implements CurrentWeatherInterface
{
    public const PROVIDER_NAME = 'openWeather';

    private const UNIT_MEASURE_METRIC = 'metric';

    public function __construct(private readonly OpenWeatherClient $client) { }

    public function getCurrentWeather(float $lat, float $lon): float
    {
        $res = $this->client->get(
            sprintf('weather?lat=%s&lon=%s&units=%s', $lat, $lon, self::UNIT_MEASURE_METRIC)
        );

        return $res['main']['temp'];
    }

    public function getProviderName(): string
    {
        return self::PROVIDER_NAME;
    }
}