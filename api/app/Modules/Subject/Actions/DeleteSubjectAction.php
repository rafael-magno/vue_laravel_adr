<?php

namespace App\Modules\Subject\Actions;

use App\Action;
use App\Exceptions\HttpResponseException;
use App\Exceptions\ItemNotFoundException;
use App\Modules\Subject\Repositories\SubjectRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class DeleteSubjectAction extends Action
{
    public function handle(int $id, SubjectRepository $subjectRepository): JsonResponse
    {
        try {
            $subject = $subjectRepository->delete($id);
        } catch (QueryException $exception) {
            throw new HttpResponseException('The record is linked to another item', 422, $exception);
        } catch (ItemNotFoundException $exception) {
            throw new HttpResponseException('Not found.', 404, $exception);
        }

        return response()->json($subject, 200);
    }
}
