<?php

namespace App\Service;

use App\Entity\CurrentWeatherRequest;
use App\Service\Api\CurrentWeatherInterface;

class FillWeatherRequestWithWeatherDataService
{
    public function __construct(private readonly array $weatherProviders) { }

    public function fillEntityWithWeatherData(CurrentWeatherRequest $entity): CurrentWeatherRequest
    {
        $successfulProviderRequestCnt = 0;
        $tempSum = 0;

        /** @var CurrentWeatherInterface $provider */
        foreach ($this->weatherProviders as $provider) {
            try {
                $providerTmp = $provider->getCurrentWeatherCached($entity);

                $entity->addWeatherDataDetail($provider->getProviderName(), $providerTmp);
                $tempSum += $providerTmp;
                $successfulProviderRequestCnt += 1;
            } catch (\Exception $exception) {
                $entity->addWeatherDataDetail($provider->getProviderName(), $exception->getMessage());
            }
        }

        if ($successfulProviderRequestCnt > 0) {
            $entity->setAverageTmp($tempSum / $successfulProviderRequestCnt);
        }

        return $entity;
    }
}