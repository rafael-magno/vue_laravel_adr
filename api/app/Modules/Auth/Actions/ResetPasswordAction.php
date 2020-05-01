<?php

namespace App\Modules\Auth\Actions;

use App\Action;
use App\Exceptions\HttpResponseException;
use App\Modules\Auth\Exceptions\ResetPasswordException;
use App\Modules\Auth\Services\ResetPasswordService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResetPasswordAction extends Action
{
    public function rules(): array
    {
        return [
            'password' => 'required|min:8',
            'confirm_password' => 'same:password',
            'hash' => 'required',
        ];
    }

    public function handle(
        Request $request,
        ResetPasswordService $resetPasswordService
    ): JsonResponse {
        $hash = $request->get('hash');
        $password = $request->get('password');

        try {
            $resetPasswordService->reset($hash, $password);
        } catch (ResetPasswordException $exception) {
            throw new HttpResponseException('Expired link.', 422, $exception);
        }

        return response()->json(['success' => true], 200);
    }
}
