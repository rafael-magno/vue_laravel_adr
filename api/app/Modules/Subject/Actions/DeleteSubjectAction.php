<?php

namespace App\Modules\Subject\Actions;

use App\Action;
use App\Modules\Subject\Repositories\SubjectRepository;

class DeleteSubjectAction extends Action
{
    public function handle(int $id, SubjectRepository $subjectRepository)
    {
        $subject = $subjectRepository->delete($id);

        return response()->json($subject, 200);
    }
}
