<?php

namespace App\Utils;

use Exception;
use Symfony\Component\HttpFoundation\Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Payload;
use Tymon\JWTAuth\Token as JWTAuthToken;

class Token
{
    public static function getCookie(String $token, ?int $maxAge = null) : Cookie
    {
        $maxAge = $maxAge ?? env('JWT_REFRESH_TTL');
        return cookie(
            'token',
            $token,
            $maxAge,
            '/',
            env('CLIENT_APP_DOMAIN'),
            false,
            true
        );
    }

    public static function decode(JWTAuthToken $currentToken) : Payload
    {
        if (!$currentToken) {
            throw new Exception('Not a JWT token');
        }

        $payload = JWTAuth::decode($currentToken);

        $valid = $payload['ip'] === request()->ip();
        $valid &= $payload['user_agent'] === request()->header('User-Agent');
        if (!$valid) {
            throw new Exception('Invalid JWT token');
        }

        return $payload;
    }

    public static function getUserId(): int
    {
        global $TOKEN_PAYLOAD;

        return $TOKEN_PAYLOAD['sub'];
    }
}
