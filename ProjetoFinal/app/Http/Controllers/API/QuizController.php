<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuizResource;
use App\Models\AnswerSubmit;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::with(['category'])->get();
        return response()->json($quizzes);
    }


    public function start(Request $request)
    {
        $request->validate(['category_id' => 'required']);

        $questions = Question::where('category_id', $request->category_id)
            ->with(['options' => function ($query) {
                $query->select('id', 'text', 'question_id'); // sem is_correct
            }])
            ->inRandomOrder()
            ->limit(8)
            ->get();

        $token = $request->bearerToken();
        $user = \App\Models\User::where('api_token', $token)->first();

        $quiz = Quiz::create([
            'user_id'     => $user->id,
            'category_id' => $request->category_id,
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

            AnswerSubmit::create([
                'quiz_id' => $quiz->id,
                'question_id'=> $answer['question_id'],
                'option_id' => $answer['option_id'],
            ]);

        }

        //guarda a pontuação e delvolve o quiz como respondido
        $quiz->update(['score' => $score, 'completed_at' => now()]);

        return response()->json([
            'score' => $score,
            'total' => count($request->answer),
        ]);

    }

    // mostra os quizzes já resolvidos pelo utilizador
    public function history(Request $request)
    {
        $token = $request->bearerToken();
        $user = \App\Models\User::where('api_token', $token)->first();

        $quizzes = Quiz::where('user_id', $user->id)
            ->with('category')
            ->Where('completed_at', '!=', null) // diferente de null ou seja os quizzes que já estão completados
            ->get();

        return response()->json($quizzes);
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz) {
        $quiz->load(['answerSubmits.question', 'answerSubmits.option', 'category']);
        return response()->json($quiz);
    }

}
