<?php

namespace App\Helper;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;

class GuzzleQueryParamMiddlewareHelper
{
    public static function addQueryParamToUri(string $paramName, string $paramValue): HandlerStack
    {
        $handler = HandlerStack::create();

        $handler->push(Middleware::mapRequest(function (RequestInterface $request) use ($paramName, $paramValue) {
            return $request->withUri(Uri::withQueryValue($request->getUri(), $paramName, $paramValue));
        }));

        return $handler;
    }
}