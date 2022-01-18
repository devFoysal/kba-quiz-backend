<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Auth\RegistrationRequest;
use App\User;
use Str;
use Response;
use Validator;
use Session;

class AuthController extends Controller
{
    public function signInForm(){
        return view('client.auth.register.index');
    }

    public function signUp(Request $request){
        
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'contactNumber' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if ($validator->passes()) {
            $user = User::where(['mobile_number' => $request->contactNumber])->get();
            if(count($user)) return Response::json(['success' => false,  'message'=>'User already exist. Please try another mobile number']);
            $newUser = new User;
            $newUser->role_id = 4;
            $newUser->full_name = $request->fullName;
            $newUser->username = Str::slug($request->fullName, "");
            $newUser->email = $request->email;
            $newUser->mobile_number = $request->contactNumber;
            $newUser->secret_key = md5($request->password);
            $newUser->status = 1;
            if($newUser->save()){
                Session::put([
                    'fuserId' => $newUser->id,
                    'roleId' => 4,
                ]);
                return Response::json(['success' => true, 'error' => null, 'message' => 'Registration successfully' , 'data' => $newUser], 201);
            }else{
                Response::json(['success' => false,  'message'=>'Please try again']);
            }
        }
        
        return Response::json(['success' => false,  'error'=>$validator->errors()->all()]);
       
    }

    public function signIn(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->passes()) {
            $user = User::where(['email' => $request->email])->get();
            if(count($user) > 0){
                Session::put([
                    'fuserId' => $user[0]->id,
                    'roleId' => 4,
                ]);
                return Response::json(['success' => true, 'error' => null, 'message' => 'Login successfully' , 'data' => $user], 201);
            }else{
                Response::json(['success' => false,  'message'=>'Please try again']);
            }
        }
        
        return Response::json(['success' => false,  'error'=>$validator->errors()->all()]);
    }
}
