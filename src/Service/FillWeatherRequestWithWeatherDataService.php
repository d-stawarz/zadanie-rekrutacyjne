<?php

namespace App\Service;

use App\Entity\CurrentWeatherRequest;
use App\Service\Api\CurrentWeatherInterface;

class FillWeatherRequestWithWeatherDataService
{
    public function __construct(private readonly array $weatherProviders) { }

    public function fillEntityWithWeatherData(CurrentWeatherRequest $entity): CurrentWeatherRequest
    {
        $successCnt = 0;
        $temp = 0;

        /** @var CurrentWeatherInterface $provider */
        foreach ($this->weatherProviders as $provider) {
            try {
                $providerTmp = $provider->getCurrentWeatherCached($entity);

                $entity->addWeatherDataDetail($provider->getProviderName(), $providerTmp);
                $temp += $providerTmp;
                $successCnt += 1;
            } catch (\Exception $exception) {
                $entity->addWeatherDataDetail($provider->getProviderName(), $exception->getMessage());
            }
        }

        if ($successCnt > 0) {
            $entity->setAverageTmp($temp / $successCnt);
        }

        return $entity;
    }
}