<?php

namespace App\Modules\Auth\Actions;

use App\Action;
use App\Utils\Token;
use Illuminate\Http\JsonResponse;
use Throwable;

class LogoutAction extends Action
{
    public function handle(): JsonResponse
    {
        try {
            auth()->logout();
        } catch (Throwable $throwable) {
        }

        return response()
            ->json(['success' => true], 200)
            ->withCookie(Token::getCookie('', -1));
    }
}
