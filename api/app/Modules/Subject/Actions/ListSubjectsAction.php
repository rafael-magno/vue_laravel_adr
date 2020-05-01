<?php

namespace App\Modules\Subject\Actions;

use App\Action;
use App\Modules\Subject\Repositories\SubjectRepository;
use Illuminate\Http\JsonResponse;

class ListSubjectsAction extends Action
{
    public function handle(SubjectRepository $subjectRepository): JsonResponse
    {
        $subjects = $subjectRepository->paginate();

        return response()->json($subjects, 200);
    }
}
