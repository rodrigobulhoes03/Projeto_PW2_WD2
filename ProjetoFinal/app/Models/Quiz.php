<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quiz extends Model
{
    protected $fillable = [
        'user_id', 'body', 'category_id', 'score', 'completed_at'
    ];

    protected $casts = [
        'completed_at' => 'datetime'
    ];

    pubblic function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
       return $this->belongsTo(Category::class);
    }

    public function answers()
    {
        return $this->belongsTo(Answers::class);
    }
}
