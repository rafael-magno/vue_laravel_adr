<?php

namespace App\Modules\Auth\Services;

use App\Modules\User\Repositories\UserRepository;
use App\Utils\Cryptography;
use Illuminate\Support\Facades\Mail;

class SendRecoveryLinkService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function send(String $email): void
    {
        $user = $this->userRepository->findOneBy(['email' => $email]);

        if ($user) {
            $recoverData = [
                'user_id' => $user->id,
                'reset_password_until' => time() + (24 * 60 * 60)
            ];

            $this->userRepository->update($recoverData, $user->id);

            $viewData = [
                'user' => $user,
                'recoverHash' => Cryptography::encode(
                    json_encode($recoverData)
                )
            ];

            Mail::send('recoverLinkMail', $viewData, function ($message) use ($user) {
                $message
                    ->to($user->email, $user->name)
                    ->subject('Password recover');
            });
        }
    }
}
