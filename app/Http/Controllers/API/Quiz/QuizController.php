<?php

namespace App\Http\Controllers\API\Quiz;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Resource
use App\Http\Resources\Quiz\QuizResourceCollection;
use App\Http\Resources\Quiz\QuizResource;

// Model
use App\Models\Quiz;


class QuizController extends Controller
{
    public function getQuizzes(){
        return QuizResourceCollection::collection(Quiz::with('questions.answers')->orderBy('id', 'desc')->get());
    }
}
