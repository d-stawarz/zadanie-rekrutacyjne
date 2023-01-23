<?php

namespace App\Service\Api;

interface CurrentWeatherInterface
{
    public function getCurrentWeather(float $lat, float $lon): float;

    public function getProviderName(): string;
}