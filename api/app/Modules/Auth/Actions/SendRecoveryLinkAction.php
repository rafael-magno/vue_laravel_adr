<?php

namespace App\Modules\Auth\Actions;

use App\Action;
use App\Modules\Auth\Services\SendRecoveryLinkService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SendRecoveryLinkAction extends Action
{
    public function rules(): array
    {
        return [
            'email' => 'required|email'
        ];
    }

    public function handle(
        Request $request,
        SendRecoveryLinkService $sendRecoveryLinkService
    ): JsonResponse {
        $email = $request->get('email');
        $sendRecoveryLinkService->send($email);

        return response()->json(['success' => true], 200);
    }
}
