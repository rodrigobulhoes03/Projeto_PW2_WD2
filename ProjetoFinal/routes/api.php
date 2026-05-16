<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\QuestionController;
use App\Http\Controllers\API\QuizController;
use App\Http\Controllers\API\AnswerSubmitController;
use App\Http\Controllers\API\CategoryController;
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
Route::get('/quizzes/history', [QuizController::class, 'history']);
Route::get('/quizzes/{quiz}', [QuizController::class, 'show']);
Route::post('/quizzes/start', [QuizController::class, 'start']);
Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit']);

//Rotas do AnswerSubmit
Route::get('/answer-submits', [AnswerSubmitController::class, 'index']);
Route::get('/answer-submits/{answerSubmit}', [AnswerSubmitController::class, 'show']);

//Rotas do CategoryController
Route::get('/categories', [CategoryController::class, 'index']);







