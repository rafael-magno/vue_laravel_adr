<?php

namespace App\Modules\Student\Actions;

use App\Action;
use App\Exceptions\HttpResponseException;
use App\Exceptions\ItemNotFoundException;
use App\Modules\Student\Repositories\StudentRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class DeleteStudentAction extends Action
{
    public function handle(int $id, StudentRepository $studentRepository): JsonResponse
    {
        try {
            $student = $studentRepository->delete($id);
        } catch (QueryException $exception) {
            throw new HttpResponseException('The record is linked to another item', 422, $exception);
        } catch (ItemNotFoundException $exception) {
            throw new HttpResponseException('Not found.', 404, $exception);
        }

        return response()->json($student, 200);
    }
}
