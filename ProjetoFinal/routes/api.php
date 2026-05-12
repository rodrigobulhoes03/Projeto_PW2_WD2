<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\QuestionController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message'=> 'Bom Dia']);
});

Route::get('/users', [UserController::class, 'index']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);
Route::patch('/users/{user}', [UserController::class, 'update']);




