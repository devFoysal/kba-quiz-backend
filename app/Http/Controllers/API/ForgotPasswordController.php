<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Modal
use App\Models\Participant;

use Response;

class ForgotPasswordController extends Controller
{
    public function verifyEmail(Request $request){
        $participant = Participant::where('email', $request->email)->first();
        if(isset($participant)) {
            return Response::json(['verified' => true], 200);
        }else {
            return Response::json(['verified' => false], 404);
        }
    }

    public function newPassword(Request $request){
        $participant = Participant::where('email', $request->email)->first();
        if(isset($participant)) {
            $participant->password = bcrypt($request->password);
            if($participant->update()) return Response::json(['status' => true], 200);
            else return Response::json(['status' => false], 404);
        }else {
            return Response::json(['status' => false], 404);
        }
    }
}