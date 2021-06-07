<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model
use App\Models\Quiz;
use App\Models\Answer;

class Question extends Model
{
    public function Quiz()
    {
        return $this->belongsTo(Quiz::class,'quizId');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'questionId');
    }
}