<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model
use App\Models\Question;

class Answer extends Model
{
    public function Question()
    {
        return $this->belongsTo(Question::class);
    }
}
