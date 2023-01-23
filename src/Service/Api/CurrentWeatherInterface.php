<?php

namespace App\Service\Api;

use App\Entity\CurrentWeatherRequest;

interface CurrentWeatherInterface
{
    public function getCurrentWeatherCached(CurrentWeatherRequest $entity): float;
}