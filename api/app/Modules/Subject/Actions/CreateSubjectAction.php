<?php

namespace App\Modules\Subject\Actions;

use App\Action;
use App\Modules\Subject\Repositories\SubjectRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateSubjectAction extends Action
{
    public function rules(): array
    {
        return [
            'name' => 'required|unique:subjects,name',
        ];
    }

    public function handle(
        SubjectRepository $subjectRepository,
        Request $request
    ): JsonResponse {
        $data = $request->all();
        $subject = $subjectRepository->create($data);

        return response()->json($subject, 201);
    }
}
