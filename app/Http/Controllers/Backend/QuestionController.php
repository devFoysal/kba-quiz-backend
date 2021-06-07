<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests\Question\NewQuestionRequest;
use App\Http\Requests\Question\UpdateQuestionRequest;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageHandleTraits;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Carbon\Carbon;
use Response;

class QuestionController extends Controller
{
    use ImageHandleTraits;

    public function index()
    {
        $questions = Question::with('Quiz')->with('Answers')->orderBy('questions.id', 'desc')->get();
        $questionCount = Question::count();
        $quizzes = Quiz::get();
        return view('backend.pages.question.list', ['totalQuestion' => $questionCount, 'quizzes' => $quizzes, 'questions' => $questions]);
    }

    public function postForm()
    {
        $quizzes = Quiz::get();
        return view('backend.pages.question.add', ['quizzes' => $quizzes]);
    }

    public function add(Request $request)
    {
            $newQuestion = new Question();
            // if ($request->has('thumbnail')) {
            //     $newQuestion->thumbnail = $this->uploadImage($request->file('thumbnail'), 'question/thumbnail');
            // }

            // if ($request->has('thumbnail_bn')) {
            //     $newQuestion->thumbnail_bn = $this->uploadImage($request->file('thumbnail_bn'), 'question/thumbnail_bn');
            // }
        
            $newQuestion->quizId = $request->quiz;
            $newQuestion->titleEn = $request->titleEn;
            $newQuestion->titleBn = $request->titleBn;
            $newQuestion->status = $request->status;
            $newQuestion->created_at = Carbon::now();
            if ($newQuestion->save()) {
                $answerEn = $request->answerEn;
                $answerBn = $request->answerBn;

                foreach($request->right_answer as $key => $rightAns) {
                    $newAnswer = new Answer();
                    $newAnswer->questionId = $newQuestion->id;
                    $newAnswer->titleEn = $answerEn[$key];
                    $newAnswer->titleBn = $answerBn[$key];
                    $newAnswer->rightAnswer = $rightAns;
                    $newAnswer->status = $request->status;
                    $newAnswer->created_at = Carbon::now();
                    $newAnswer->save();
                }
                return redirect('management/question/list')->with(['class' => 'callout-success', 'message' => 'Question added']);
            }else {
            return back()->with(['class' => 'callout-danger', 'message' => 'Please try again!']);
        }
    }

    public function edit($id)
    {
        $question = Question::with('Quiz')->with('Answers')->where(['questions.id' => $id])->orderBy('questions.id', 'desc')->first();
        if (!!$question) {
            return Response::json(['success' => true, 'data' => $question], 200);
        } else {
            return Response::json(['success' => false, 'data' => 'Not found'], 404);
        }
    }

    public function update(Request $request)
    {
        $question = Question::findOrFail($request->questionId);
        if ($request->has('thumbnail')) {
            $this->deleteImage($question->thumbnail, 'question/thumbnail');
            $question->thumbnail = $this->uploadImage($request->file('thumbnail'), 'question/thumbnail');
        }

        if ($request->has('thumbnail_bn')) {
            $this->deleteImage($question->thumbnail, 'question/thumbnail_bn');
            $question->thumbnail_bn = $this->uploadImage($request->file('thumbnail_bn'), 'question/thumbnail_bn');
        }
    
        $question->quiz_id = $request->quiz;
        // $question->title_en = $request->titleEn;
        // $question->title_bn = $request->titleBn;
        $question->status = $request->status;
        if ($question->save()) {
            $answerEn = $request->answerEn;
            $answerBn = $request->answerBn;
            $answerId = $request->answerId;
            $answers = Answer::where(['questionId' => $question->id])->get();
            foreach($request->right_answer as $key => $rightAns) {
                
                if(isset($answers[$key]) && (int)$answers[$key]->id === (int)$answerId[$key]){
                    $answers[$key]->questionId = $question->id;
                    $answers[$key]->title_en = $answerEn[$key];
                    $answers[$key]->title_bn = $answerBn[$key];
                    $answers[$key]->right_answer = $rightAns;
                    $answers[$key]->status = $request->status;
                    $answers[$key]->save();
                }else{
                    $newAnswer = new Answer();
                    $newAnswer->questionId = $question->id;
                    $newAnswer->title_en = $answerEn[$key];
                    $newAnswer->title_bn = $answerBn[$key];
                    $newAnswer->right_answer = $rightAns;
                    $newAnswer->status = $request->status;
                    $newAnswer->save();
                }
            }
            return redirect('management/question/list')->with(['class' => 'callout-success', 'message' => 'Question added']);
        }else {
            return back()->with(['class' => 'callout-danger', 'message' => 'Please try again!']);
        }
    }

    public function delete($id)
    {
        $question = Question::findOrFail($id);
        if ($question->delete()) {
            $this->deleteImage($question->thumbnail, 'question/thumbnail');
            $this->deleteImage($question->thumbnail_bn, 'question/thumbnail_bn');
            Answer::where(['questionId' => $id])->delete();
            return Response::json(['success' => true, 'message' => 'Question deleted.'], 200);
        } else {
            return Response::json(['success' => false, 'message' => 'Please try again'], 404);
        }
    }
    public function answerDelete($id)
    {
        $answer = Answer::findOrFail($id);
        if ($answer->delete()) {
            return Response::json(['success' => true, 'message' => 'Answer deleted.'], 200);
        } else {
            return Response::json(['success' => false, 'message' => 'Please try again'], 404);
        }
    }
}