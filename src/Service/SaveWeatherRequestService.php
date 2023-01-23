<?php

namespace App\Service;

use App\Entity\CurrentWeatherRequest;
use App\Repository\CurrentWeatherRequestRepository;

class SaveWeatherRequestService
{
    public function __construct(
        private readonly CurrentWeatherRequestRepository $repository,
        private readonly FillWeatherRequestWithWeatherDataService $service
    ) { }

    public function save(CurrentWeatherRequest $entity): CurrentWeatherRequest
    {
        $entity = $this->service->fillEntityWithWeatherData($entity);

        $this->repository->save($entity, true);

        return $entity;
    }
}