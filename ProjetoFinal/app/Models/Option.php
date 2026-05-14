<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'text', 'is_correct', 'question_id'
    ];

    protected $casts = [
        'is_correct' => 'boolean'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
