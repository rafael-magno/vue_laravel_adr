<?php

namespace App\Modules\Subject\Actions;

use App\Action;
use App\Modules\Subject\Repositories\SubjectRepository;

class ListSubjectsAction extends Action
{
    public function handle(SubjectRepository $subjectRepository)
    {
        $subjects = $subjectRepository->paginate();

        return response()->json($subjects, 200);
    }
}
