<?php

namespace App\Http\Controllers\API\Participant;

use App\Http\Controllers\Controller;

// JWT
use JWTAuth;

// Validation
use Illuminate\Http\Request;


// Model
use App\Models\Participant;

use Laravel\Socialite\Facades\Socialite;
// Helper
use Auth;
use Response;


class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','getSocialLogin']]);
    }

    public function login(Request $request){
        // return Response::json($request->all());
        
       try {
           if(ctype_digit($request->email)){
                $credentials = [
                    'contactNumber' => $request->email,
                    'password' => $request->password,
                ];
           }else{
                $credentials = $request->only('email', 'password');
           }
            
            if ($token = $this->guard('api')->attempt($credentials)) {
                return $this->respondWithToken($token);
            }

            return  Response::json(['message' => 'Email or Password invalid'], 401);
       } catch (JWTException $ex) {
            return Response::json(['error' => $ex]);
        }        
    }

    
    public function getSocialLogin(Request $request) {

        $service = '';
        // return response()->json($request->token);
        if($request->service == 'google') $service = 'google';
        else if($request->service == 'facebook') $service = 'facebook';
        try {
            $user = Socialite::driver($service)->userFromToken($request->token);

         
            $participant = Participant::where('email',$user->email)->first();
        
            if(!$participant) {
                $newParticipant = new Participant;

                $newParticipant->fullName = $user->getName();
                $newParticipant->email = $user->getEmail();
                $newParticipant->avater =  ($service == 'google') ?  $user->getAvatar() : $request->value['picture']['data']['url'];
                $newParticipant->password = bcrypt('123456');
                $newParticipant->save();

                if($newParticipant->save()){
        
                    $newParticipant = Participant::where('email',$user->email)->where('status',1)->first();
                    return $this->respondWithSocialToken(JWTAuth::fromUser($newParticipant),$newParticipant);

                }else {
                    return response()->json(['message'=>"Sorry We Couldn't Create Account"],401);
                }
            }
            if($participant->status == 0) {
                return response()->json(['message' => "$request->service Account Has been Suspended"],401);
            }
           
            return $this->respondWithSocialToken(JWTAuth::fromUser($participant),$participant);
            
           
    
         

          
        } catch (Exception $e) {
            if($e->getCode() == 401) {
                return response()->json(['success'=>false,'message' => 'Unauthorized or Invalid Token']);
            }else {
                return response()->json(['success'=>false,'message' => 'Something Went Wrong On Server'.$e]);
            }
           
          
        }
     
    }

    public function me()
    {
        return response()->json($this->guard('api'));
        // $user = $this->guard('api')->user();
        // $user['picture'] = asset("storage/images/user/picture/$user->picture");
        
    }

    public function logout()
    {
        $this->guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        $participant = Participant::findOrFail(Auth::user()->id);
        $participant['picture'] = asset("storage/images/user/picture/$participant->picture");
        return response()->json([
            'participant' => $participant,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard('api')->factory()->getTTL() * 60
        ]);
    }

    protected function respondWithSocialToken($token,$participant) {
       
        return response()->json([
            'participant' => $participant,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard('api')->factory()->getTTL() * 60
        ]);
    }

    public function guard()
    {
        return Auth::guard('api');
    }
}