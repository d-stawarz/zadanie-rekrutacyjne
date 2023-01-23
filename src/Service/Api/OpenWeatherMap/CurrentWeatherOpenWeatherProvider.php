<?php

namespace App\Service\Api\OpenWeatherMap;

use App\Service\Api\CurrentWeather;

final class CurrentWeatherOpenWeatherProvider extends CurrentWeather
{
    public const PROVIDER_NAME = 'openWeather';

    private const UNIT_MEASURE_METRIC = 'metric';

    public function __construct(private readonly OpenWeatherClient $client, #[\SensitiveParameter] string $redisDSN)
    {
        parent::__construct($redisDSN);
    }

    protected function getCurrentWeather(float $lat, float $lon): float
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