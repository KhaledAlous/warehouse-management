<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;


class LoginController extends Controller
{
    //
    public function Login(LoginRequests $request){
        $data = $request->validate();
        $user = User::where('email', $data['email'])->first();
        if (!hash::check($data['password'],$user->password)){
            return $this->sendError('invalid credentials');
        }
        $user->access_token = $user->createToken('user_token',['test-token','test-ability'])->plainTextToken;
        return $this->sendResponse(LoginResource::make($user), 'login successfully');
    }
   public function logout(){
    $user = auth('user')->user();
   }
}