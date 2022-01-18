<?php

namespace App\Http\Controllers\API\Participant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Modal
use App\Models\Participant;

// Request
use App\Http\Requests\Participant\NewParticipantRequest;
use App\Http\Requests\Participant\UpdateParticipantRequest;
use App\Http\Traits\ImageHandleTraits;
use Response;
use JWTAuth;

class ParticipantController extends Controller
{
    use ImageHandleTraits;
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
            if ($request->file('avatar')) {
                $newParticipant->avater =    $this->uploadImage($request->file('avatar'), 'images/user');
            }
            $newParticipant->save();

            return Response::json(['message' => 'User created successfully', 'data' => $newParticipant], 201);
        } catch (\Throwable $th) {
            return Response::json($th, 422);
        }
    }

    public function updateParticipant(Request $request) {
        $user = JWTAuth::user();

        $request->validate([
            'avatar' =>  'sometimes|mimes:jpg,jpeg,png|max:300',
            'contactNumber' => 'required|digits:11|unique:participants,contactNumber,'.$user->id,
        ]);

        $participant = Participant::find($user->id);

        $participant->contactNumber = $request->contactNumber;
        if ($request->file('avatar')) {
            if (!empty($participant->avater)) {
                $this->deleteImage($participant->logo, 'user');
            }
            $participant->avater =    $this->uploadImage($request->file('avatar'), 'images/user');
        }

        if($participant->save()) {

            return response()->json(['success' => true,'message' => 'Updated information','$re' => $request]);
        }

       

    }
}