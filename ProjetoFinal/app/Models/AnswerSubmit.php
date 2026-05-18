<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerSubmit extends Model
{
    protected $fillable = [
        'quiz_id', 'question_id', 'option_id'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
