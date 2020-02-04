<?php

namespace App\Modules\Shift\Repositories;

use App\Modules\Shift\Models\Shift;
use App\Repository;

class ShiftRepository extends Repository
{
    public function __construct(Shift $shift)
    {
        $this->model = $shift;
    }
}
