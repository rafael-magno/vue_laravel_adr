<?php

namespace App\Modules\Shift\Actions;

use App\Entities\Shift;
use Lorisleiva\Actions\Action;

class GetShiftAction extends Action
{
    public function handle(int $id)
    {
        return response()->json(Shift::find($id), 200);
    }
}