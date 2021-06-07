<?php

namespace App\Http\Controllers\API\Participant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Modal
use App\Models\Participant;

// Request
use App\Http\Requests\Participant\NewParticipantRequest;
use App\Http\Requests\Participant\UpdateParticipantRequest;

use Response;

class ParticipantController extends Controller
{

    public function getParticipants(){
        try {
            return Response::json(Participant::where(['status' => 1])->get(), 200);
        } catch (\Throwable $th) {
            return Response::json($th, 404);
        }
    }

    public function getParticipant($participantId){
        try {
            return Response::json(Participant::find($participantId), 200);
        } catch (\Throwable $th) {
            return Response::json(['message' => 'Not found'], 404);
        }
    }

    public function createParticipant(NewParticipantRequest $request){
        try {
            
            $newParticipant = new Participant;

            $newParticipant->fullName = $request->fullName;
            $newParticipant->email = $request->email;
            $newParticipant->contactNumber = $request->contactNumber;
            $newParticipant->address = $request->address;
            $newParticipant->gender = $request->gender;
            $newParticipant->age = $request->age;
            $newParticipant->password = bcrypt($request->password);
            $newParticipant->save();

            return Response::json(['message' => 'User created successfully', 'data' => $newParticipant], 201);
        } catch (\Throwable $th) {
            return Response::json($th, 422);
        }
    }
}
