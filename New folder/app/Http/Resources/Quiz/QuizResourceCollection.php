<?php

namespace App\Http\Resources\Quiz;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResourceCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'titleBn' => $this->titleBn,
            'titleEn' => $this->titleEn,
            'duration' => $this->duration*1000,
            'questions' => $this->questions->map(function($question){
                return [
                    'id' => $question->id,
                    'titleEn' => $question->titleEn,
                    'titleBn' => $question->titleBn,
                    'answers' => $question->answers->map(function($answer){
                        return [
                            'id' => $answer->id,
                            'titleEn' => $answer->titleEn,
                            'titleBn' => $answer->titleBn
                        ];
                    })
                ];
            })
        ];
    }
}