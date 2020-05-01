<?php

namespace App\Modules\Auth\Actions;

use App\Action;
use App\Exceptions\HttpResponseException;
use App\Utils\Token;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginAction extends Action
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
    }

    public function handle(Request $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);
        $token = auth()->attempt($credentials);

        if (!$token) {
            throw new HttpResponseException('Unauthorized', 401);
        }

        return response()
            ->json(['success' => true], 200)
            ->withCookie(Token::getCookie($token));
    }
}
