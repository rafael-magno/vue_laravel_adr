<?php

namespace App\Modules\Student\Actions;

use App\Action;
use App\Modules\Student\Repositories\StudentRepository;
use Illuminate\Http\JsonResponse;

class ListStudentsAction extends Action
{
    public function handle(StudentRepository $studentRepository): JsonResponse
    {
        $students = $studentRepository->paginate();

        return response()->json($students, 200);
    }
}
