<?php

namespace App\Http\Controllers\API\Quiz;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Resource
use App\Http\Resources\Quiz\QuizResourceCollection;
use App\Http\Resources\Quiz\QuizResource;
use App\Leaderboard;
use App\Models\Participant;
// Model
use App\Models\Quiz;
use App\QuizStart;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;
use Carbon\Carbon;

class QuizController extends Controller
{


    public function getQuizzes(Request $request){

        $date = date('Y-m-d');
        $language = $request->header('language','bn');


        $user = JWTAuth::user();

        $leaderboard = Leaderboard::where('participantId',$user->id)->whereDate('created_at', $date)->first();

        if($leaderboard) {
            return response()->json(['message' =>  ($language == 'bn')? 'দুঃখিত আপনি ইতিমধ্যে কুইজটি   খেলে ফেলেছেন। পুনরায় কুইজ খেলার সুযোগ নেই' : 'Sorry Already Quiz Played .You can not play this quiz again'],420);
        }else{
            $user->quizStart = 0;
            $user->update();
        }

        if($user->quizStart == 2 || $user->quizStart > 2) {
            return response()->json(['message' =>  ($language == 'bn')? 'দুঃখিত আপনি ইতিমধ্যে কুইজটি  দুইবার খেলে ফেলেছেন। পুনরায় কুইজ খেলার সুযোগ নেই' : 'Sorry Already Played 2 times.You can not play this quiz again'],420);
        }

        return QuizResourceCollection::collection(
            Quiz::where(['status' => 1])
            ->with('questions.answers')
            ->whereHas('questions.answers', function($query){
                $query->where('status', 1);
            })->orderBy('id', 'desc')->get());
    }

    public function startQuize(Request $request) {
        
        $date = date('Y-m-d');
        
        $user = JWTAuth::user();

        $user = Participant::find($user->id);
        $language = $request->header('language','bn');

        // $leaderboard = Leaderboard::where('participantId',$user->id)->first();

        // if($leaderboard) {

        //     return response()->json(['error' => 'Already Quiz Played'],422);
        // }

        // if($user->quizStart == 2 || $user->quizStart > 2 )  return response()->json(['error' => 'Already Quiz Played'],422);
        
        $leaderboard = Leaderboard::where('participantId',$user->id)->whereDate('created_at', $date)->first();

        if($leaderboard != null) {
            return response()->json(['error' =>  ($language == 'bn')? 'দুঃখিত আপনি ইতিমধ্যে কুইজটি   খেলে ফেলেছেন। পুনরায় কুইজ খেলার সুযোগ নেই' : 'Sorry Already Quiz Played .You can not play this quiz again'],422);
        }else{
            $user->quizStart = 0;
            $user->update();
        }
        
        

        if($user->quizStart == 2 || $user->quizStart>2) {
            return response()->json(['error' =>  ($language == 'bn')? 'দুঃখিত আপনি ইতিমধ্যে কুইজটি  দুইবার খেলে ফেলেছেন। পুনরায় কুইজ খেলার সুযোগ নেই' : 'Sorry Already Played 2 times.You can not play this quiz again'],422);
        }
        

        $user->quizStart =  $user->quizStart + 1; 
        $user->quizStartTime = $request->date;

        if($user->save()) {

            $quizeStart = new QuizStart;

            $quizeStart->participantId = $user->id;
            $quizeStart->quizStartTime = date('Y-m-d H:i:s',$request->date/1000);

            $quizeStart->save();
            
            return response()->json('success');
        }
      
    }


    // public function getLeaderboard() {

    //     // $Leaderboard = Leaderboard::orderBy('correctAnswer','DESC')->orderBy('finishTime','ASC')->limit(10)->get();

    //     // $finalResult = [];

    //     // foreach($Leaderboard as $result) {
    //     //     $finalResult[] = [
    //     //         'participantId' => $result->participant->id,
    //     //         'participant' => $result->participant->fullName,
    //     //         'correctAnswer' => $result->correctAnswer,
    //     //         'time' => $result->finishTime,
    //     //     ];
    //     // }
    //     /*============================*/
    //     $Leaderboard = Leaderboard::orderBy('correctAnswer','DESC')->orderBy('finishTime','ASC')->get();
    //     $finalResult = $Leaderboard->groupBy(function($d) {
    //             return Carbon::parse($d->created_at)->format('m');
    //         })->map(function($data,$key) {
    //             $filterData = $data->map(function($result, $key) {
    //                 if($key < 10 && $result->correctAnswer == 3 and (int)$result->finishTime > 0){
    //                         return [
    //                             'participantId' => $result->participant->id,
    //                             'participantAvater' => $result->participant->avater,
    //                             'participant' => $result->participant->fullName,
    //                             'participantEmail' => $result->participant->email,
    //                             'participantContactNumber' => $result->participant->contactNumber,
    //                             'correctAnswer' => $result->correctAnswer,
    //                             'time' => $result->finishTime,
    //                             'date' => date('d F, Y', strtotime($result->created_at)),
    //                     ];
    //                 }
    //             });
    //             return $filterData->unique('participantId')->filter(function ($value) { return !is_null($value); })->values()->all();
    //         });
        
    //     return response()->json(['result' => $finalResult]);
    // }


    public function getLeaderboard() {
        $Leaderboard = Leaderboard::with('participant')->where(['correctAnswer' => 3])->where('finishTime', '>', 0)->orderBy('correctAnswer','DESC')->orderBy('finishTime','ASC')->get();
        $finalResult = $Leaderboard->groupBy(function($d) {
                return Carbon::parse($d->created_at)->format('m');
            })->sortByDesc(function($key, $value){
                return $value;
            })->map(function($data, $key){
                if($key != '09'){
                    return $data;
                }
            })->filter(function ($value) { return !is_null($value); })->map(function($data,$key) {
                $filterData = $data->map(function($result, $key) {
                    return [
                        'participantId' => $result->participant->id,
                        'participantAvater' => $result->participant->avater,
                        'participant' => $result->participant->fullName,
                        'participantEmail' => $result->participant->email,
                        'participantContactNumber' => $result->participant->contactNumber,
                        'correctAnswer' => $result->correctAnswer,
                        'time' => $result->finishTime,
                        'date' => date('d F, Y', strtotime($result->created_at)),
                    ];
                });

                return $filterData->unique('participantId');
            })->map(function($limitData){return $limitData->take(10)->values()->all();});

            return response()->json(['result' => $finalResult]);

    }
}