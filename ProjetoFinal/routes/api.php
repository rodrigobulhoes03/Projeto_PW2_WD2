<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\QuestionController;
use App\Http\Controllers\API\QuizController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message'=> 'Bom Dia']);
});

//Rotas dos Users
Route::get('/users', [UserController::class, 'index']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);
Route::patch('/users/{user}', [UserController::class, 'update']);

//Rotas dos Questions
Route::get('/questions', [QuestionController::class, 'index']);
Route::get('/questions/{question}', [QuestionController::class, 'show']);

Route::middleware('is_admin')->group(function () {
    Route::post('questions', [QuestionController::class, 'store']);
    Route::put('questions/{question}', [QuestionController::class, 'update']);
    Route::delete('questions/{question}', [QuestionController::class, 'destroy']);
});

//Rotas dos Quizzes
Route::get('/quizzes', [QuizController::class, 'index']);
Route::get('/quizzes/{quiz}', [QuizController::class, 'show']);
Route::get('/quizzes/{quiz}' ,[QuizController::class, 'history']);

Route::middleware('is_admin')->group(function () {
    Route::post('quizzes', [QuizController::class, 'store']);
    Route::put('quizzes/{quiz}', [QuizController::class, 'update']);
    Route::delete('quizzes/{quiz}', [QuizController::class, 'destroy']);
});








