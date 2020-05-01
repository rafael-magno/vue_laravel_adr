<?php

namespace App\Modules\Subject\Actions;

use App\Action;
use App\Exceptions\HttpResponseException;
use App\Exceptions\ItemNotFoundException;
use App\Modules\Subject\Repositories\SubjectRepository;
use Illuminate\Http\JsonResponse;

class GetSubjectAction extends Action
{
    public function handle(int $id, SubjectRepository $subjectRepository): JsonResponse
    {
        try {
            $subject = $subjectRepository->findOrFail($id);
        } catch (ItemNotFoundException $exception) {
            throw new HttpResponseException('Not found.', 404, $exception);
        }

        return response()->json($subject, 200);
    }
}
