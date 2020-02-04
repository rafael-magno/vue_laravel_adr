<?php

namespace App\Modules\Student\Actions;

use App\Action;
use App\Modules\Student\Repositories\StudentRepository;
use Illuminate\Http\Request;

class CreateStudentAction extends Action
{
    public function rules()
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
    ) {
        $student = $studentRepository->create($request->all());

        return response()->json($student, 201);
    }
}
