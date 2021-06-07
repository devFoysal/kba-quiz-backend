<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model
use App\Models\Question;

class Quiz extends Model
{
    public function questions()
    {
        return $this->hasMany(Question::class, 'quizId');
    }
}
