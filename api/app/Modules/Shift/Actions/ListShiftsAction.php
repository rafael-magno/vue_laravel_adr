<?php

namespace App\Modules\Shift\Actions;

use App\Entities\Shift;
use Lorisleiva\Actions\Action;

class ListShiftsAction extends Action
{
    public function handle()
    {
        return response()->json(Shift::all(), 200);
    }
}