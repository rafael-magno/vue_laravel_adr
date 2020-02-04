<?php

namespace App\Modules\Student\Actions;

use App\Action;
use App\Modules\Student\Repositories\StudentRepository;
use Illuminate\Http\Request;

class UpdateStudentAction extends Action
{
    public function rules(int $id)
    {
        return [
            'name' => 'required|unique:students,name'.$id,
            'shift_id' => 'required|exists:shifts,id',
            'subjects_id.*' => 'required|exists:subjects,id',
        ];
    }

    public function handle(int $id, StudentRepository $studentRepository, Request $request)
    {
        $student = $studentRepository->update($request->all(), $id);

        return response()->json($student, 200);
    }
}
