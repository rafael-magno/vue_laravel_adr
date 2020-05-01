<?php

namespace App\Modules\Subject\Actions;

use App\Action;
use App\Exceptions\HttpResponseException;
use App\Exceptions\ItemNotFoundException;
use App\Modules\Subject\Repositories\SubjectRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateSubjectAction extends Action
{
    public function rules(int $id): array
    {
        return [
            'name' => 'unique:subjects,name,'.$id,
        ];
    }

    public function handle(
        int $id,
        SubjectRepository $subjectRepository,
        Request $request
    ): JsonResponse {
        $data = $request->all();

        try {
            $subject = $subjectRepository->update($data, $id);
        } catch (ItemNotFoundException $exception) {
            throw new HttpResponseException('Not found.', 404, $exception);
        }

        return response()->json($subject, 200);
    }
}
