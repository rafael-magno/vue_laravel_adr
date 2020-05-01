<?php

namespace App\Modules\Student\Actions;

use App\Action;
use App\Modules\Student\Repositories\StudentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateStudentAction extends Action
{
    public function rules(): array
    {
        return [
            'name' => 'required|unique:students,name',
            'shift_id' => 'required|exists:shifts,id',
            'subjects_id.*' => 'required|exists:subjects,id',
        ];
    }

    public function handle(
        StudentRepository $studentRepository,
        Request $request
    ): JsonResponse {
        $data = $request->all();
        $student = $studentRepository->create($data);

        return response()->json($student, 201);
    }
}
