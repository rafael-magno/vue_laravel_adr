<?php

use App\Modules\Auth\Actions\LoginAction;
use App\Modules\Auth\Actions\LogoutAction;
use App\Modules\Auth\Actions\ResetPasswordAction;
use App\Modules\Auth\Actions\SendRecoveryLinkAction;
use Illuminate\Support\Facades\Route;

Route::post('/auth', LoginAction::class);
Route::delete('/auth', LogoutAction::class);
Route::post('/auth/password-recovery-link', SendRecoveryLinkAction::class);
Route::post('/auth/reset-password', ResetPasswordAction::class);
