<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegiseterController extends Controller
{
    //
     public function Register (UserRegisterRequest $request){
        $user = User::create($request ->validated());
        $token = $user ->creat();
    }
}