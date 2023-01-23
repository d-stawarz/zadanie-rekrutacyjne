<?php

namespace App\Service\Api;

use App\Entity\CurrentWeatherRequest;
use App\Helper\CacheKeyNameHelper;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Contracts\Cache\ItemInterface;

abstract class CurrentWeather implements CurrentWeatherInterface
{
    protected const PROVIDER_NAME = '';

    public const FIFTEEN_MINUTES_IN_SECONDS = 900;

    private RedisAdapter $redisAdapter;

    public function __construct(#[\SensitiveParameter] string $redisDSN)
    {
        $this->redisAdapter = new RedisAdapter(RedisAdapter::createConnection($redisDSN));
    }

    abstract protected function getCurrentWeather(float $lat, float $lon): float;

    public function getCurrentWeatherCached(CurrentWeatherRequest $entity): float
    {
        return $this->redisAdapter->get(CacheKeyNameHelper::getProviderLocationTmpKeyName($this->getProviderName(), $entity->getSearchText()), function (ItemInterface $item) use($entity) {
            $item->expiresAfter(self::FIFTEEN_MINUTES_IN_SECONDS);

            return $this->getCurrentWeather($entity->getLat(), $entity->getLon());
        });
    }

    public function getProviderName(): string
    {
        return static::PROVIDER_NAME;
    }
}