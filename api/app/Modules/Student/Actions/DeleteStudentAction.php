<?php

namespace App\Modules\Student\Actions;

use App\Action;
use App\Modules\Student\Repositories\StudentRepository;

class DeleteStudentAction extends Action
{
    public function handle(int $id, StudentRepository $studentRepository)
    {
        $student = $studentRepository->delete($id);

        return response()->json($student, 200);
    }
}
