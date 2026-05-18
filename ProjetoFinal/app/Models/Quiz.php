<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quiz extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'score', 'completed_at'
    ];

    protected $casts = [
        'completed_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
       return $this->belongsTo(Category::class);
    }

    public function answerSubmits()
    {
        return $this->hasMany(AnswerSubmit::class);
    }

    public function totalScore(): int
    {
        return $this->answerSubmits()
            ->where('is_correct', true)
            ->count();
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'quiz_question');
    }
}
