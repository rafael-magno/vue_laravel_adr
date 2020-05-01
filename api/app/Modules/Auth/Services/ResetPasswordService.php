<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Exceptions\ResetPasswordException;
use App\Modules\User\Repositories\UserRepository;
use App\Utils\Cryptography;

class ResetPasswordService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function reset(string $hash, string $password): void
    {
        $userId = $this->getUserIdFromHash($hash);
        $user = $this->userRepository->findOneBy([
            'id' => $userId,
            'reset_password_until' => ['>=', time()],
        ]);

        if (!$user) {
            throw new ResetPasswordException('User not found or expired request.');
        }

        $this->userRepository->update([
            'password' => $password,
            'reset_password_until' => null,
        ], $user->id);
    }

    public function getUserIdFromHash(string $hash): int
    {
        $recoverData = json_decode(
            Cryptography::decode($hash),
            true
        );

        if (!$recoverData) {
            throw new ResetPasswordException('Invalid hash.');
        }

        if (time() > $recoverData['reset_password_until']) {
            throw new ResetPasswordException('Expired link.');
        }

        return $recoverData['user_id'];
    }
}
