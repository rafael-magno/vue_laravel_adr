<?php

namespace App\Modules\Shift\Actions;

use App\Action;
use App\Modules\Shift\Repositories\ShiftRepository;

class DeleteShiftAction extends Action
{
    public function handle(int $id, ShiftRepository $shiftRepository)
    {
        $shift = $shiftRepository->delete($id);

        return response()->json($shift, 200);
    }
}
