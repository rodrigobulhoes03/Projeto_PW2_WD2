<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerSubmitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'is_correct' => $this->is_correct,
            'question' => [
                'id' => $this->question->id,
                'body' => $this->question->body,
            ],
            'option' => [
                'id' => $this->option->id,
                'text' => $this->option->text,
            ],
            'quiz' => [
                'id' => $this->quiz->id,
                'score' => $this->quiz->score,
            ],
        ];
    }
}
