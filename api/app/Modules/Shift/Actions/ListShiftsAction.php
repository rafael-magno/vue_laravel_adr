<?php

namespace App\Modules\Shift\Actions;

use App\Action;
use App\Modules\Shift\Repositories\ShiftRepository;

class ListShiftsAction extends Action
{
    public function handle(ShiftRepository $shiftRepository)
    {
        $shifts = $shiftRepository->paginate();

        return response()->json($shifts, 200);
    }
}
