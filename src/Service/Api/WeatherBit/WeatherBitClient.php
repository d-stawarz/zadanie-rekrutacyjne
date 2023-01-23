<?php

namespace App\Service\Api\WeatherBit;

use App\Helper\GuzzleQueryParamMiddlewareHelper;
use GuzzleHttp\Client;

class WeatherBitClient
{
    private const BASE_URI = 'https://api.weatherbit.io/v2.0/';

    private const AUTHENTICATION_QUERY_PARAM_NAME = 'key';

    private Client $client;

    public function __construct(#[\SensitiveParameter] string $weatherBitApiKey)
    {
        $this->client = new Client([
            'base_uri' => self::BASE_URI,
            'handler' => GuzzleQueryParamMiddlewareHelper::addQueryParamToUri(self::AUTHENTICATION_QUERY_PARAM_NAME, $weatherBitApiKey),
        ]);
    }

    public function get(string $uri): array
    {
        $response = $this->client->get($uri);

        return json_decode($response->getBody(), true);
    }
}