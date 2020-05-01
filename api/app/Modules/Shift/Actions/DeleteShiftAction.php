<?php

namespace App\Modules\Shift\Actions;

use App\Action;
use App\Exceptions\HttpResponseException;
use App\Exceptions\ItemNotFoundException;
use App\Modules\Shift\Repositories\ShiftRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class DeleteShiftAction extends Action
{
    public function handle(int $id, ShiftRepository $shiftRepository): JsonResponse
    {
        try {
            $shift = $shiftRepository->delete($id);
        } catch (QueryException $exception) {
            throw new HttpResponseException('The record is linked to another item', 422, $exception);
        } catch (ItemNotFoundException $exception) {
            throw new HttpResponseException('Not found.', 404, $exception);
        }

        return response()->json($shift, 200);
    }
}
