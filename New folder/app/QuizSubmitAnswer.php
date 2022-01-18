<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizSubmitAnswer extends Model
{
    protected $fillable = ['participantId','answerId','time'];
}