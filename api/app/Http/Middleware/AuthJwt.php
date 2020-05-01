<?php
namespace App\Http\Middleware;

use App\Exceptions\HttpResponseException;
use App\Utils\Token;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Closure;
use Symfony\Component\HttpFoundation\Session\Session;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthJwt
{
    public function handle(Request $request, Closure $next) : JsonResponse
    {
        $newToken = false;
        $currentToken = JWTAuth::getToken();

        try {
            $payload = Token::decode($currentToken);
        } catch (TokenExpiredException $exception) {
            try {
                $newToken = JWTAuth::refresh($currentToken);
                $request->headers->set('authorization', 'Bearer ' . $newToken);
            } catch (Throwable $error) {
                throw new HttpResponseException('INVALID_TOKEN', 401, $exception);
            }
        } catch (Throwable $exception) {
            throw new HttpResponseException('INVALID_TOKEN', 401, $exception);
        }

        $response = $next($request);

        if ($newToken) {
            $response->withCookie(Token::getCookie($newToken));
            $payload = Token::decode($newToken);
        }

        session()->put('tokenPayload', $payload);

        return $response;
    }
}
