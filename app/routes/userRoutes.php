<?php

use App\Http\Controllers\UserController;
use App\Http\Utils\ResponseFormatHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('current-user', fn (Request $request) => ResponseFormatHandler::sendResponse('Usuário autenticado', $request->user()));

Route::get('users', [UserController::class, 'read']);
Route::get('users/{uuid}', [UserController::class, 'readOne']);
Route::post('users', [UserController::class, 'store']);
Route::put('users/{uuid}', [UserController::class, 'update']);
Route::delete('users/{uuid}', [UserController::class, 'delete']);

// Route::post('register',[UserController::class,'register']);
// Route::post('login',[UserController::class,'login']);
// Route::post('logout',[UserController::class,'logout'])->middleware('auth:sanctum');
