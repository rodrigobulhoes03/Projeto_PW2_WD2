<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $fillable = [
        'title', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function getCorrectOptions()
    {
        return $this->options()->where('is_correct', true)->first();
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class, 'quiz_question');
    }
}
