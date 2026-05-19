<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with(['category', 'options'])->get();
        return response()->json($questions);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'options' => 'required|array|min:2|max:6',
            'options.*.text' => 'required|string|max:255',
            'options.*.is_correct' => 'required|boolean',
        ]);

        // para ter pelo menos 1 resposta certa
        $correctCount = collect($request->options)
            ->where('is_correct', true)->count();

        if ($correctCount !== 1) {
            return response()->json([
                'message' => 'A pergunta deve ter exatamente uma resposta correta.'
            ], 422);
        }

        $question = Question::create([
            'body' => $request->body,
            'category_id' => $request->category_id,
        ]);

        foreach ($request->options as $option) {
            $question->options()->create($option);
        }

        return response()->json($question->load('options'), 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $date = $request->all();
        $question->update($date);
        return new QuestionResource($question->load(['category', 'options']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return response()->noContent();
    }
}
