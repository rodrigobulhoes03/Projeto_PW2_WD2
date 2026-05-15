<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function start(Request $request)
    {
        $request->validate(['category' => 'required']);

        $questions = Question::Where('category', $request->category)
        ->with('options')
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $quiz = Quiz::create([
            'user_id'  =>$request->user()->id,
            'category' => $request->category,
        ]);

        return response()->json([
            'quiz' => $quiz,
            'questions' => $questions
        ]);
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $request->validate([
           'answer' => 'required|array',
            'answer.*.question_id' => 'required|exists:questions,id',
            'answer.*.option_id' => 'required|exists:options,id',
        ]);

        $score = 0;

        foreach ($request->answer as $answer) {
            $option = Option::find($answer['option_id']);
            $is_correct = $option->is_correct;

            if ($is_correct) {
                $score ++ ; //calcula +1 ponto a cada resposta que acertarmos
            }

            QuizAnswer::create([
               'quiz_id' => $quiz->id,
                'question_id'=> $answer['question_id'],
                'option_id' => $answer['option_id'],
                'is_correct' => $is_correct,
            ]);

            //guarda a pontuação e delvolve o quiz como respondido
            $quiz->update(['score' => $score, 'completed_at' => now()]);
        }

        return response()->json([
            'score' => $score,
            'total' => 8
        ]);

    }

    // mostra os quizzes já resolvidos pelo utilizador
    public function history(Request $request)
    {
        $quizzes = Quiz::Where('user_id', $request->user()->id)
            ->with('category')
            ->Where('completed_at', '!=', null) // diferente de null ou seja os quizzes que já estão complerados
            ->get();

        return response()->json($quizzes);
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz) {
        $quiz->load(['answers.question', 'answers.option', 'category']);
        return response()->json($quiz);
    }


}
