<?php

namespace App\Modules\User\Repositories;

use App\Modules\User\Models\User;
use App\Repository;

class UserRepository extends Repository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
