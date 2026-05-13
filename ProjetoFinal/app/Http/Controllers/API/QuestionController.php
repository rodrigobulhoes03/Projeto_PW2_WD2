<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use http\Env\Response;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return QuestionResource::collection(Question::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $question = Question::create([
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id')
        ]);

        return response()->json($question, 201);
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
        return response()->notContrnt();
    }
}
