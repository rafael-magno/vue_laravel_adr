<?php

namespace App\Modules\Subject\Repositories;

use App\Modules\Subject\Models\Subject;
use App\Repository;

class SubjectRepository extends Repository
{
    public function __construct(Subject $subject)
    {
        $this->model = $subject;
    }
}
