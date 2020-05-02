<?php

namespace App\Modules\Shift\Actions;

use App\Action;
use App\Modules\Shift\Repositories\ShiftRepository;
use App\Utils\Token;
use Illuminate\Http\JsonResponse;

class ListShiftsAction extends Action
{
    public function handle(ShiftRepository $shiftRepository): JsonResponse
    {
        $shifts = $shiftRepository->paginate();

        return response()->json($shifts, 200);
    }
}
