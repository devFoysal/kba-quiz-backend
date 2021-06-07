<?php

namespace App\Http\Controllers\API\Participate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Modal
use App\Models\Result;

// Request
use App\Http\Requests\Participate\ParticipateRequest;

use Carbon\Carbon;
use Response;

class ParticipateController extends Controller
{
    public function create(ParticipateRequest $request){
       
        try {
            
            $participate = new Result;
            $participate->participantId = $request->participantId;
            $participate->answerId = $request->answerId;
            $participate->answerDateTime = Carbon::now();
            $participate->save();

            return Response::json(['message' => 'Success'], 201);
        } catch (\Throwable $th) {
            return Response::json($th, 422);
        }
    }
}
