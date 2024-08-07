<?php

use App\Http\Utils\ResponseFormatHandler;
use Illuminate\Support\Facades\Route;

Route::get(
    'auth/password-reset',
    fn () => response()->json(
        ResponseFormatHandler::sendError('Recurso não implemenado')
    )
)->name('password.reset');
