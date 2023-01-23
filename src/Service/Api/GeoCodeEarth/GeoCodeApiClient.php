<?php

namespace App\Service\Api\GeoCodeEarth;

use Geocoder\Provider\GeocodeEarth\GeocodeEarth;
use Geocoder\Provider\Provider;
use Geocoder\Query\ReverseQuery;
use GuzzleHttp\Client;

class GeoCodeApiClient
{
    private Provider $provider;

    public function __construct(#[\SensitiveParameter] string $geocodeEarthApiKey)
    {
        $httpClient = new Client();
        $this->provider = new GeocodeEarth($httpClient, $geocodeEarthApiKey);
    }

    public function doCityExists(float $lat, float $lng): bool
    {
        try {
            $this->provider->reverseQuery(
                ReverseQuery::fromCoordinates($lat, $lng)
            );

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}