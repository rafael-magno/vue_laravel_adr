<?php

use App\Modules\Shift\Actions\ListShiftsAction;
use Illuminate\Support\Facades\Route;

Route::get('/shifts', ListShiftsAction::class);
