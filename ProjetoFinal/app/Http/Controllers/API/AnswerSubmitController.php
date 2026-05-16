<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnswerSubmitResource;
use App\Models\AnswerSubmit;
use Illuminate\Http\Request;

class AnswerSubmitController extends Controller
{
    public function index()
    {
        return AnswerSubmitResource::collection(
            AnswerSubmit::with(['quiz', 'question', 'option'])->get()
        );
    }

    public function show(AnswerSubmit $answerSubmit)
    {
        return new AnswerSubmitResource(
            $answerSubmit->load(['quiz', 'question', 'option'])
        );
    }
}
