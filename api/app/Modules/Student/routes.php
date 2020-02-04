<?php

use App\Modules\Student\Actions\CreateStudentAction;
use App\Modules\Student\Actions\DeleteStudentAction;
use App\Modules\Student\Actions\GetStudentAction;
use App\Modules\Student\Actions\ListStudentsAction;
use App\Modules\Student\Actions\UpdateStudentAction;
use Illuminate\Support\Facades\Route;

Route::post('/students', CreateStudentAction::class);
Route::get('/students', ListStudentsAction::class);
Route::get('/students/{id}', GetStudentAction::class);
Route::put('/students/{id}', UpdateStudentAction::class);
Route::delete('/students/{id}', DeleteStudentAction::class);
