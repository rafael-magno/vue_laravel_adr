<?php

namespace App\Modules\Student\Actions;

use App\Action;
use App\Exceptions\HttpResponseException;
use App\Exceptions\ItemNotFoundException;
use App\Modules\Student\Repositories\StudentRepository;
use Illuminate\Http\JsonResponse;

class GetStudentAction extends Action
{
    public function handle(int $id, StudentRepository $studentRepository): JsonResponse
    {
        try {
            $student = $studentRepository->findOrFail($id);
        } catch (ItemNotFoundException $exception) {
            throw new HttpResponseException('Not found.', 404, $exception);
        }

        return response()->json($student, 200);
    }
}
