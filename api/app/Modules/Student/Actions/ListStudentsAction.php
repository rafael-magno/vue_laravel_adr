<?php

namespace App\Modules\Student\Actions;

use App\Action;
use App\Modules\Student\Repositories\StudentRepository;

class ListStudentsAction extends Action
{
    public function handle(StudentRepository $studentRepository)
    {
        $students = $studentRepository->paginate();

        return response()->json($students, 200);
    }
}
