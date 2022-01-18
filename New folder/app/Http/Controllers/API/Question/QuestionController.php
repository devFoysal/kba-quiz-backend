<?php

namespace App\Http\Controllers\API\Question;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Leaderboard;
use App\Models\Answer;
use App\Models\Participant;
use App\Models\Quiz;
use App\QuizSubmitAnswer;
use DB;
use JWTAuth;

class QuestionController extends Controller
{

    public function submitQuize(Request $request) {
        $date = date('Y-m-d');
        $user = JWTAuth::user();

        $user = Participant::find($user->id);

        $leaderboard = Leaderboard::where('participantId',$user->id)->whereDate('created_at', $date)->first();

        if($leaderboard) {

             return response()->json(['error' =>  ($language == 'bn')? 'দুঃখিত আপনি ইতিমধ্যে কুইজটি   খেলে ফেলেছেন। পুনরায় কুইজ খেলার সুযোগ নেই' : 'Sorry Already Quiz Played .You can not play this quiz again'],422);


            // return response()->json(['error' => 'Already Quiz Played'],422);
        }


        $diff = $request->endTime -  $user->quizStartTime; /// here find the miliseconds for finsihing the quiz 

        $submitAnswer = [];
        $correctAnswer = 0;
        foreach($request->answerLists as $answer) {

            $submitAnswer[] = [
                'participantId' => $user->id,
                'answerId' => $answer['answerId'],
                'time' => $answer['time'],
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $ans = Answer::find($answer['answerId']);
            if($ans && $ans->rightAnswer == 1) $correctAnswer +=1;
        }

        QuizSubmitAnswer::insert($submitAnswer);

        $leaderboard = new Leaderboard;

        $leaderboard->participantId  = $user->id;
        $leaderboard->quizStartTime = date('Y-m-d H:i:s',$user->quizStartTime/1000);
        $leaderboard->quizEndTime = date('Y-m-d H:i:s',$request->endTime/1000);
        $leaderboard->correctAnswer = $correctAnswer;
        $leaderboard->totalTime =  DB::table('quizzes')->whereIn('id',[1,2,3])->sum('duration');
        $leaderboard->finishTime  =  $diff;




        if($leaderboard->save()) {
            $result = count($submitAnswer).' টি প্রশ্নের ভিতর '.$correctAnswer.' টি প্রশ্নের সঠিক উত্তর দিয়েছেন';
            return response()->json(['message'=>$result,'diff' => $diff,'second' => $diff/1000,'answer' => $submitAnswer,'corectAnswer' => $correctAnswer]);
        }else {
            return response()->json(['message'=>'Internal Server Error'],422); 
        }

      
    }
}