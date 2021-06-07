<?php

namespace App\Http\Controllers\API\Participant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

// JWT
use JWTAuth;

// Validation
use Illuminate\Http\Request;
use App\Http\Requests\Customer\NewCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;

// Model
use App\Models\Participant;
use App\Models\Order;
use App\Models\ShippingAddress;

// Helper
use Auth;
use Carbon\Carbon;
use Str;
use Response;
use Mail;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
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

    public function guard()
    {
        return Auth::guard('api');
    }
}
