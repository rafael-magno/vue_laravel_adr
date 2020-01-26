<?php

namespace App\Modules\Shift\Actions;

use App\Entities\Shift;
use Lorisleiva\Actions\Action;

class DeleteShiftAction extends Action
{
    public function handle(int $id)
    {
        Shift::destroy($id);
        return response()->json('', 204);
    }
}