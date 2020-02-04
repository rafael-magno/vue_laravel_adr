<?php

namespace App\Modules\Shift\Actions;

use App\Action;
use App\Modules\Shift\Repositories\ShiftRepository;

class GetShiftAction extends Action
{
    public function handle(int $id, ShiftRepository $shiftRepository)
    {
        $shift = $shiftRepository->findOrFail($id);

        return response()->json($shift, 200);
    }
}
