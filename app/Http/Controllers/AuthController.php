<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\loginDataCheck;
use App\User;
use Session;
class AuthController extends Controller
{
    public function login(){
        return view('backend.auth.login');
    }

    public function checkValidUser(loginDataCheck $request){
        $user = User::where(['username'=>$request->username, 'secret_key' => md5($request->userPassword), 'status' => '1'])->first();

        if (!!$user) {
            $sessionData = [
                'authId' => $user->id,
                'isAuthenticated' => true
            ];
            Session::put($sessionData);
            Session::flash('message', 'Login successfull');
            // return $user;
          return redirect()->route('quiz.list');
        }else{
            Session::flash('error', 'Invalid email or password');
            return redirect("/management");
        }
    }

    public function logout()
    {
        Session::flush();
        Session::flash('message', 'Logout Successful'); 
        return redirect('/management');
    }
}
