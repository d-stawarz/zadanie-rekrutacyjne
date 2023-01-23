<?php

namespace App\Service\Api\OpenWeatherMap;

use App\Helper\GuzzleQueryParamMiddlewareHelper;
use GuzzleHttp\Client;

class OpenWeatherClient
{
    private const BASE_URI = 'https://api.openweathermap.org/data/2.5/';

    private const AUTHENTICATION_QUERY_PARAM_NAME = 'appid';

    private Client $client;

    public function __construct(#[\SensitiveParameter] string $openWeatherApiKey)
    {
        $this->client = new Client([
            'base_uri' => self::BASE_URI,
            'handler' => GuzzleQueryParamMiddlewareHelper::addQueryParamToUri(self::AUTHENTICATION_QUERY_PARAM_NAME, $openWeatherApiKey),
        ]);
    }

    public function get(string $uri): array
    {
        $response = $this->client->get($uri);

        return json_decode($response->getBody(), true);
    }
}