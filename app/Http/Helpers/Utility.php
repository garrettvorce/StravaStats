<?php

namespace App\Http\Helpers;

use Psr\Http\Message\ResponseInterface;

class Utility
{

    public static function toArray(ResponseInterface $response)
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}