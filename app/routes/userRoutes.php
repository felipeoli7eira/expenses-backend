<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('users', [UserController::class, 'read']);
Route::get('users/{uuid}', [UserController::class, 'readOne']);
Route::post('users', [UserController::class, 'store']);
Route::put('users/{uuid}', [UserController::class, 'update']);
Route::delete('users/{uuid}', [UserController::class, 'delete']);
