<?php

use App\Modules\User\Repositories\UserRepository;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(UserRepository $userRepository)
    {
        $user = $userRepository->findOneBy(['email' => 'teste@gmail.com']);

        if (!$user) {
            $userRepository->create([
                'name' => 'teste teste',
                'email' => 'teste@gmail.com',
                'password' => '12345678',
            ]);
        }
    }
}
