<?php
namespace App\Http\Middleware;

use App\Exceptions\HttpResponseException;
use App\Utils\Token;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Session;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token as JWTAuthToken;

class AuthJwt
{
    public function handle(Request $request, Closure $next) : JsonResponse
    {
        global $TOKEN_PAYLOAD;

        $newToken = false;
        $currentToken = JWTAuth::getToken();
        try {
            $TOKEN_PAYLOAD = Token::decode($currentToken);
        } catch (TokenExpiredException $exception) {
            try {
                $newToken = JWTAuth::refresh($currentToken);
                $newToken = new JWTAuthToken($newToken);
                $request->headers->set('authorization', 'Bearer ' . $newToken);
                $TOKEN_PAYLOAD = Token::decode($newToken);
            } catch (Throwable $exception) {
                throw new HttpResponseException('INVALID_TOKEN', 401, $exception);
            }
        } catch (Throwable $exception) {
            throw new HttpResponseException('INVALID_TOKEN', 401, $exception);
        }

        $response = $next($request);

        if ($newToken) {
            $response->withCookie(Token::getCookie($newToken));
        }

        return $response;
    }
}
