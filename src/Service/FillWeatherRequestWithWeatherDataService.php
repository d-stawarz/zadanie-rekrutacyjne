<?php

namespace App\Service;

use App\Entity\CurrentWeatherRequest;
use App\Helper\CacheKeyNameHelper;
use App\Service\Api\CurrentWeatherInterface;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class FillWeatherRequestWithWeatherDataService
{
    public const FIFTEEN_MINUTES_IN_SECONDS = 900;

    private RedisAdapter $redisAdapter;

    public function __construct(private readonly array $weatherProviders, #[\SensitiveParameter] string $redisDSN)
    {
        $this->redisAdapter = new RedisAdapter(RedisAdapter::createConnection($redisDSN));
    }

    public function fillEntityWithWeatherData(CurrentWeatherRequest $entity): CurrentWeatherRequest
    {
        $successCnt = 0;
        $temp = 0;

        /** @var CurrentWeatherInterface $provider */
        foreach ($this->weatherProviders as $provider) {
            try {
                $providerTmp = $this->redisAdapter->get(CacheKeyNameHelper::getProviderLocationTmpKeyName($provider->getProviderName(), $entity->getSearchText()), function (ItemInterface $item) use($provider, $entity) {
                    $item->expiresAfter(self::FIFTEEN_MINUTES_IN_SECONDS);

                    return $provider->getCurrentWeather($entity->getLat(), $entity->getLon());
                });

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