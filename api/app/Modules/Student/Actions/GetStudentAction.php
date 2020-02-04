<?php

namespace App\Modules\Student\Actions;

use App\Action;
use App\Modules\Student\Repositories\StudentRepository;

class GetStudentAction extends Action
{
    public function handle(int $id, StudentRepository $studentRepository)
    {
        $student = $studentRepository->findOrFail($id);

        return response()->json($student, 200);
    }
}
