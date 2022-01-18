<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests\Quiz\NewQuizRequest;
use App\Http\Requests\Quiz\UpdateQuizRequest;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageHandleTraits;
use App\Models\Quiz;
use Carbon\Carbon;
use Response;
use Storage;
use File;
use App\Leaderboard;
use App\Models\Participant;
use DB;

class QuizController extends Controller
{
    use ImageHandleTraits;

    
    public function index()
    {

        if (request()->ajax()) {
            return datatables()->of(Quiz::get())
                ->addColumn('sr', function ($data) {
                    return $data->id;
                })
                ->editColumn('duration',function($data) {

                    return $data->duration.' seconds';

                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = '<small class="label pull-right bg-green">Active</small>';
                    } elseif ($data->status == 0) {
                        $status = '<small class="label pull-right bg-red">Inaction</small>';
                    }
                    return $status;
                })
                ->addColumn('created_at', function ($data) {
                    return date('d F Y', strtotime($data->created_at));
                })
                ->addColumn('action', function ($data) {
                    $button = '<a class="edit btn btn-primary" id="' . $data->id . '"><i class="fa fa-edit"></i></a> <a class="delete btn btn-danger" id="' . $data->id . '"><i class="fa fa-trash"></i></a>';
                    return $button;
                })
                ->rawColumns(['sr', 'action', 'status', 'created_at'])->make(true);
        }
        $quizCount = Quiz::count();
        return view('backend.pages.quiz.list', ['totalQuiz' => $quizCount]);
    }

    public function postForm()
    {
        return view('backend.pages.quiz.add');
    }

    public function add(Request $request)
    {
        
        $newQuiz = new Quiz();

        // if ($request->has('thumbnail')) {
        //     $newQuiz->thumbnail = $this->uploadImage($request->file('thumbnail'), 'quiz/thumbnail');
        // }
        $newQuiz->titleEn = $request->titleEn;
        $newQuiz->titleBn = $request->titleBn;
        $newQuiz->duration = $request->duration;
        // $newQuiz->shortDescriptionEn = $request->shortDescriptionEn;
        // $newQuiz->shortDescriptionEn = $request->shortDescriptionBn;
        $newQuiz->status = $request->status;
        $newQuiz->created_at = Carbon::now();

        if ($newQuiz->save()) {
            return redirect('management/quiz/list')->with(['class' => 'callout-success', 'message' => 'Quiz added']);
        } else {
            return back()->with(['class' => 'callout-danger', 'message' => 'Please try again!']);
        }
    }

    public function edit($id)
    {
        $quiz = Quiz::find($id);
        if (!!$quiz) {
            return Response::json(['success' => true, 'data' => $quiz], 200);
        } else {
            return Response::json(['success' => false, 'data' => 'Not found'], 404);
        }
    }

    public function update(UpdateQuizRequest $request)
    {
        // dd($request->all());
        $quiz = Quiz::findOrFail($request->quizId);

        // if ($request->has('thumbnail')) {
        //     $this->deleteImage($quiz->thumbnail, 'quiz/thumbnail');
        //     $quiz->thumbnail = $this->uploadImage($request->file('thumbnail'), 'quiz/thumbnail');
        // }        
        $quiz->titleEn = $request->titleEn;
        $quiz->titleBn = $request->titleBn;
        $quiz->status = $request->status;
        $quiz->duration = $request->duration;
        $quiz->updated_at = Carbon::now();
        if ($quiz->save()) {
            return redirect('management/quiz/list')->with(['class' => 'callout-success', 'message' => 'Quiz updated.']);
        } else {
            return back()->with(['class' => 'callout-danger', 'message' => 'Please try again!']);
        }
    }

    public function delete($id)
    {
        $quiz = Quiz::findOrFail($id);
        if ($quiz->delete()) {
            $this->deleteImage($quiz->thumbnail, 'quiz/thumbnail');
            return Response::json(['success' => true, 'message' => 'Quiz deleted.'], 200);
        } else {
            return Response::json(['success' => false, 'message' => 'Please try again'], 404);
        }
    }
    
    public function getLeaderboard() {

        // $Leaderboard = Leaderboard::orderBy('correctAnswer','DESC')->orderBy('finishTime','ASC')->take(10)->get();
        $Leaderboard = Leaderboard::orderBy('correctAnswer','DESC')->orderBy('finishTime','ASC')->get();
        $finalResult = $Leaderboard->groupBy(function($d) {
                return Carbon::parse($d->created_at)->format('m');
            })->map(function($data,$key) {
                $filterData = $data->map(function($result, $key) {
                    if($key < 10 && $result->correctAnswer == 3){
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
                    }
                });
                return $filterData->unique('participantId')->filter(function ($value) { return !is_null($value); })->values()->all();
            });


        // $finalResult = [];

        // foreach($Leaderboard as $result) {
        //     $finalResult[] = [
        //         'participantId' => $result->participant->id,
        //         'participant' => $result->participant->fullName,
        //         'correctAnswer' => $result->correctAnswer,
        //         'time' => $result->finishTime,
        //         'date' => date('d F, Y', strtotime($result->created_at)),
        //     ];
        // }

        return view('backend.pages.leaderboard.list', ['finalResult' => $finalResult]);

    }

    public function getCertificate($participantId) {

        // return Quiz::with('questions.answers')
        // ->orderBy('id', 'desc')
        // ->get();

        $participant = Participant::findOrFail($participantId);
        // return $participant;
        return view('backend.pages.leaderboard.certificate', compact('participant'));

    }
}