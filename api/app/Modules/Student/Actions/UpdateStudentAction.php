<?php

namespace App\Modules\Student\Actions;

use App\Action;
use App\Exceptions\HttpResponseException;
use App\Exceptions\ItemNotFoundException;
use App\Modules\Student\Repositories\StudentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateStudentAction extends Action
{
    public function rules(int $id): array
    {
        return [
            'name' => 'required|unique:students,name'.$id,
            'shift_id' => 'required|exists:shifts,id',
            'subjects_id.*' => 'required|exists:subjects,id',
        ];
    }

    public function handle(
        int $id,
        StudentRepository $studentRepository,
        Request $request
    ): JsonResponse {
        $data = $request->all();

        try {
            $student = $studentRepository->update($data, $id);
        } catch (ItemNotFoundException $exception) {
            throw new HttpResponseException('Not found.', 404, $exception);
        }

        return response()->json($student, 200);
    }
}
